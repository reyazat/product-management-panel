<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:191', Rule::unique('products', 'name')->ignore($this->input('editid'))],
            'slug' => ['nullable', 'string', 'min:3', 'max:191', Rule::unique('products', 'slug')->ignore($this->input('editid'))],
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'image' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'sku' => 'nullable|string',
            'tags' => 'nullable|string',
            'price' => 'required|decimal:2',
            'supplier_price' => 'nullable|decimal:2',
            'weight' => 'nullable|decimal:2',
            'length' => 'nullable|decimal:2',
            'width' => 'nullable|decimal:2',
            'height' => 'nullable|decimal:2',
            'date_available' => 'nullable|date',
            'quantity' => 'nullable|integer',
            'minimum' => 'nullable|integer',
            'tax_class_id' => 'nullable|integer',
            'manufacturer_id' => 'nullable|integer',
            'sorted' => 'nullable|integer',
            'status' => 'required|integer',
            'categories' => 'array',
            'related_products' => 'array',
            'images.*' => 'required',
            'specialprice.*.target_market_id' => 'integer',
            'specialprice.*.quantity' => 'required',
            'specialprice.*.price' => 'required',
            'options'=>'array',
            'optionvalues.*.option_value_id' => 'required',
            'optionvalues.*.price' => 'required|numeric',
            'optionvalues.*.quantity' => 'required|numeric',
            'optionvalues.*.point' => 'numeric',
            'optionvalues.*.option_id' => 'integer',
            'optionvalues.*.price_prefix' => 'string',
            'optionvalues.*.point_prefix' => 'string',
        ];
    }

    public function messages(): array
    {
        return [
            'images.*' =>  'در صورت اضافه کردن سطر جدید در بخش تصاویر فیلد تصویر را انتخاب کنید',
            'specialprice.*.quantity' => 'در صورت اضافه کردن سطر جدید در بخش قیمت ویژه فیلد مقدار را پر  کنید',
            'specialprice.*.price' => 'در صورت اضافه کردن سطر جدید در بخش قیمت ویژه فیلد قیمت را پر کنید',
            'optionvalues.*.option_value_id' => 'در صورت اضافه کردن سطر جدید در بخش گزینه ها فیلد مقدار را انتخاب کنید',
            'optionvalues.*.price' => 'در صورت اضافه کردن سطر جدید در بخش گزینه ها فیلد قیمت را پر کنید',
            'optionvalues.*.quantity' => 'در صورت اضافه کردن سطر جدید در بخش گزینه ها فیلد تعداد را پر کنید',
            'optionvalues.*.point' => 'در صورت اضافه کردن سطر جدید در بخش گزینه ها فیلد امتیاز باید عدد یا رشته‌ای از اعداد باشد',
        ];
    }
}
