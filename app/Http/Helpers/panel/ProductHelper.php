<?php

namespace App\Http\Helpers\panel;

use App\Models\Product;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ProductHelper
{

    public function getAll()
    {

        return Product::select(['id', 'name', 'price', 'quantity', 'status'])->with('categories')->orderByDesc('id')->get();
    }

    public function getSuggest(Request $request)
    {

        return Product::select(['id', 'name', 'price', 'quantity', 'status'])->where('status', '=', 1)->where('name', 'LIKE', "%{$request->input('q')}%")->orderByDesc('id')->Paginate(10);
    }


    public function getActive()
    {
        return Product::with('options','relatedProducts','productImages','manufacturer','taxClass','categories')->where('status', '=', 1)->orderByDesc('sorted')->get();
    }

    public function deleteAll($ids)
    {
        return Product::whereIn('id', explode(',', $ids))->delete();
    }

    public function store($data)
    {
        if (isset($data['slug']) && !empty($data['slug']))
            $slug = SlugService::createSlug(Product::class, 'slug', $data['slug']);
        else
            $slug = SlugService::createSlug(Product::class, 'slug', $data['name']);
        $product = new Product();
        $product->name =  $data['name'];
        $product->slug =  $slug;
        $product->description =  $data['description'];
        $product->short_description =  $data['short_description'];
        $product->image =  isset($data['image']) ? $data['image'] : null;
        $product->meta_title =  $data['meta_title'];
        $product->meta_description =  $data['meta_description'];
        $product->sku =  $data['sku'];
        $product->tags =  $data['tags'];
        $product->price =  $data['price'];
        $product->supplier_price =  isset($data['supplier_price']) ? $data['supplier_price'] : 0.0;
        $product->weight =  isset($data['weight']) ? $data['weight'] : 0.0;
        $product->length =  isset($data['length']) ? $data['length'] : 0.0;
        $product->width =  isset($data['width']) ? $data['width'] : 0.0;
        $product->height =  isset($data['height']) ? $data['height'] : 0.0;
        $product->date_available =  $data['date_available'];
        $product->quantity =  $data['quantity'];
        $product->minimum =  isset($data['minimum']) ? $data['minimum'] : 0.0;
        $product->tax_class_id =  $data['tax_class_id'];
        $product->manufacturer_id =  $data['manufacturer_id'];
        $product->sorted =  isset($data['sorted']) ? $data['sorted'] : 0;
        $product->status =  $data['status'];

        $data['categories'] = isset($data['categories']) ? $data['categories'] : null;
        $data['related_products'] = isset($data['related_products']) ? $data['related_products'] : null;
        $data['optionvalues'] = isset($data['optionvalues']) ? $data['optionvalues'] : null;
        $data['options'] = isset($data['options']) ? $data['options'] : null;
        $data['specialprice'] = isset($data['specialprice']) ? $data['specialprice'] : null;
        $data['images'] = isset($data['images']) ? $data['images'] : null;

        $product->save();
        $id = $product->id;
        $product->categories()->sync($data['categories']);
        try {
            $product->customerGroups()->sync($data['specialprice']);
        } catch (QueryException $e) {
            return ['type' => 'error', 'data' => ['id' => $id], 'code' => 23000, 'message' => 'در بخش قیمت ویژه رکورد تکراری ارسال کردید. لطفا اطلاعات صحیح را وارد کنید.'];
        }
        try {
            $product->relatedProducts()->sync($data['related_products']);
        } catch (QueryException $e) {
            return ['type' => 'error', 'code' => 23000, 'data' => ['id' => $id], 'message' => 'در بخش محصولات مرتبط رکورد تکراری ارسال کردید. لطفا اطلاعات صحیح را وارد کنید.'];
        }
        if (!empty($data['images'])) {
            $product->productImages()->delete();
            $product->productImages()->createMany($data['images']);
        }
        try {
            $product->options()->sync($data['options']);
        } catch (QueryException $e) {
            return ['type' => 'error', 'code' => 23000, 'data' => ['id' => $id], 'message' => 'در بخش گزینه ها رکورد تکراری ارسال کردید. لطفا اطلاعات صحیح را وارد کنید.'];
        }
        try {
            $product->optionValues()->sync($data['optionvalues']);
        } catch (QueryException $e) {
            return ['type' => 'error', 'code' => 23000, 'data' => ['id' => $id], 'message' => 'در بخش گزینه ها رکورد تکراری ارسال کردید. لطفا اطلاعات صحیح را وارد کنید.'];
        }

        return ['type' => 'success', 'code' => 200,];
    }

    /**
     * @return array
     */
    public function update($product, $data)
    {
        if (isset($data['slug']) && !empty($data['slug']))
            $slug = $data['slug'];
        else
            $slug = SlugService::createSlug(Product::class, 'slug', $data['name']);

        $data['slug'] = $slug;
        $data['image'] = isset($data['image']) ? $data['image'] : null;
        $data['height'] = isset($data['height']) ? $data['height'] : 0.0;
        $data['width'] = isset($data['width']) ? $data['width'] : 0.0;
        $data['length'] = isset($data['length']) ? $data['length'] : 0.0;
        $data['minimum'] = isset($data['minimum']) ? $data['minimum'] : 0.0;
        $data['weight'] = isset($data['weight']) ? $data['weight'] : 0.0;
        $data['sorted'] = isset($data['sorted']) ? $data['sorted'] : 0;
        $data['supplier_price'] = isset($data['supplier_price']) ? $data['supplier_price'] : 0.0;
        $data['categories'] = isset($data['categories']) ? $data['categories'] : null;
        $data['related_products'] = isset($data['related_products']) ? $data['related_products'] : null;
        $data['optionvalues'] = isset($data['optionvalues']) ? $data['optionvalues'] : null;
        $data['options'] = isset($data['options']) ? $data['options'] : null;
        $data['specialprice'] = isset($data['specialprice']) ? $data['specialprice'] : null;
        $data['images'] = isset($data['images']) ? $data['images'] : null;

        $product->update($data);
        $product->categories()->sync($data['categories']);
        try {
            $product->customerGroups()->sync($data['specialprice']);
        } catch (QueryException $e) {
            return ['type' => 'error', 'code' => 23000, 'message' => 'در بخش قیمت ویژه رکورد تکراری ارسال کردید. لطفا اطلاعات صحیح را وارد کنید.'];
        }
        try {
            $product->relatedProducts()->sync($data['related_products']);
        } catch (QueryException $e) {
            return ['type' => 'error', 'code' => 23000, 'message' => 'در بخش محصولات مرتبط رکورد تکراری ارسال کردید. لطفا اطلاعات صحیح را وارد کنید.'];
        }
        if (!empty($data['images'])) {
            $product->productImages()->delete();
            $product->productImages()->createMany($data['images']);
        }
        try {
            $product->options()->sync($data['options']);
        } catch (QueryException $e) {
            return ['type' => 'error', 'code' => 23000, 'message' => 'در بخش گزینه ها رکورد تکراری ارسال کردید. لطفا اطلاعات صحیح را وارد کنید.'];
        }
        try {
            $product->optionValues()->sync($data['optionvalues']);
        } catch (QueryException $e) {
            return ['type' => 'error', 'code' => 23000, 'message' => 'در بخش گزینه ها رکورد تکراری ارسال کردید. لطفا اطلاعات صحیح را وارد کنید.'];
        }

        return ['type' => 'success', 'code' => 200,];
    }
}
