<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use App\Http\Helpers\panel\CategoryHelper;
use App\Http\Helpers\panel\ManufacturerHelper;
use App\Http\Helpers\panel\OptionHelper;
use App\Http\Helpers\panel\ProductHelper;
use App\Http\Helpers\panel\TargetMarketHelper;
use App\Http\Helpers\panel\TaxClassHelper;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $helper;
    public function __construct(ProductHelper $helper)
    {
        $this->middleware(['auth', 'CheckAdmin']);
        $this->helper = $helper;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageinfo = [
            'title' => __('Products'),
            'description' => 'description',
            'keywords' => 'keywords',
            'owner' => 'owner',
            'breadcrumbs' => [
                ['Home', __('Products'), __('Products')],
                ['dashboard.index', 'products.panel', 'products.panel']
            ],
        ];

        return view('panel.product', compact('pageinfo'));
    }


    public function indexJson()
    {
        $products = $this->helper->getAll();

        return response()->json(['type' => 'success', 'code' => 200, 'message' => '', 'data' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageinfo = [
            'title' => __('Products'),
            'description' => 'description',
            'keywords' => 'keywords',
            'owner' => 'owner',
            'breadcrumbs' => [
                ['Home', __('Products'), __('Products'), __('Edit')],
                ['dashboard.index', 'products.panel', 'products.panel', 'products.panel']
            ],
        ];


        $taxclassHelper = new TaxClassHelper();
        $taxclasses = $taxclassHelper->getActive();
        $categoryHelper = new CategoryHelper();
        $categories = $categoryHelper->getAll();
        $manufacturerHelper = new ManufacturerHelper();
        $manufacturers = $manufacturerHelper->getActive();
        $hp = new TargetMarketHelper();
        $cgroups = $hp->getActiveCustomerGroup()->pluck('name','id');
        $oHp = new OptionHelper();
        $options = $oHp->getAll();

        return view('panel.addproduct', compact('pageinfo','taxclasses','categories','manufacturers','cgroups','options'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $validation = $request->validated();
        $save = $this->helper->store($validation);

        if($save['type'] == 'success')
        return redirect()->route('products.panel')->with('success', __('The action was executed successfully.'));
        else
        return redirect()->route('products.edit',$save['data']['id'])->with('warning',$save['message']);

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {   $product->load('relatedProducts');
        $product->load('categories');
        $pageinfo = [
            'title' => __('Products'),
            'description' => 'description',
            'keywords' => 'keywords',
            'owner' => 'owner',
            'breadcrumbs' => [
                ['Home', __('Products'), __('Products'), __('Edit')],
                ['dashboard.index', 'products.panel', 'products.panel', 'products.panel']
            ],
        ];


        $taxclassHelper = new TaxClassHelper();
        $taxclasses = $taxclassHelper->getActive();
        $categoryHelper = new CategoryHelper();
        $categories = $categoryHelper->getAll();
        $manufacturerHelper = new ManufacturerHelper();
        $manufacturers = $manufacturerHelper->getActive();
        $hp = new TargetMarketHelper();
        $cgroups = $hp->getActiveCustomerGroup()->pluck('name','id');
        $oHp = new OptionHelper();
        $options = $oHp->getAll();

        return view('panel.editproduct', compact('pageinfo','product','taxclasses','categories','manufacturers','cgroups','options'));
    }

    public function editJson(Request $request)
    {
        $page = $request->exists('page')?$request->input('page'):1;
        $results =[];
        $products = $this->helper->getSuggest($request);
        foreach ($products as $value) {
            $results['results'][] = ['id'=>$value->id,'text'=>$value->name];
        }
        $results['pagination']['more'] = ($page * $products->perPage()) < $products->total();

        return response()->json($results);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {

        $validation = $request->validated();
        ~~dd($validation);
        $update = $this->helper->update( $product,$validation);

        if($update['type'] == 'success')
        return redirect()->route('products.panel')->with('success', __('The action was executed successfully.'));
        else
        return redirect()->route('products.edit',$product->id)->with('warning',$update['message']);

    }
    public function statusupdate(Request $request, Product $product)
    {
        $validation = $request->validate([
            'status' => 'required|integer',
            'ajax' => 'required|boolean',
        ]);
        $product->update($validation);
        if ($validation['ajax'])
            return response()->json(['type' => 'success', 'code' => 200, 'message' => 'success', 'data' => []]);
        else
            return redirect()->route('manufacturers.panel')->with('success', __('The action was executed successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['type' => 'success', 'code' => 200, 'message' => 'success', 'data' => []]);
    }
    public function destroyAll(Request $request)
    {
        $ids = $request->input('grpids');
        $this->helper->deleteAll($ids);

        return response()->json(['type' => 'success', 'code' => 200, 'message' => 'success', 'data' => []]);
    }
}
