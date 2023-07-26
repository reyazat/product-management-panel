<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Helpers\panel\ProductHelper;
use App\Http\Resources\api\v1\ProductResource;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $helper;
    public function __construct(ProductHelper $helper)
    {
        $this->helper = $helper;
    }

    public function index(){

        $products = $this->helper->getActive();
        return new ProductResource($products);

    }
}
