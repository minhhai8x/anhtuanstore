<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use App\Model\Product;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show all products with lazy loading
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $listProduct = DB::table('products')
            ->leftJoin('product_images', 'products.id', '=', 'product_images.product_id')
            ->orderBy('products.created_at', 'desc')
            ->select('products.id', 'products.name', 'products.price', 'product_images.image_path')
            ->paginate(Config::get('constants.records_per_page.products'));
        $listCate = DB::table('categories')
            ->orderBy('id','desc')->get();
        $this->data['title'] = __('main.title.products');
        $this->data['listCate'] = $listCate;
        $this->data['listProduct'] = $listProduct;
        $this->data['product_image_path'] = Config::get('constants.path.upload_image_path');
        $this->data['currency'] = Config::get('constants.default.currency');

        return view('layouts.product.index', $this->data);
    }

    /**
     * Show all products with pagination
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($locale, $pid)
    {
        $product = Product::find($pid);
        $listCate = DB::table('categories')
            ->orderBy('id','desc')->get();

        // Recommended products
        $recommendedProducts = DB::table('products')
            ->leftJoin('product_images', 'products.id', '=', 'product_images.product_id')
            ->where('products.category_id', $product->category_id)
            ->where('products.id', '<>', $product->id)
            ->orderBy('products.created_at', 'desc')
            ->select('products.id', 'products.name', 'products.price', 'product_images.image_path')
            ->paginate(Config::get('constants.records_per_page.recommended_products'));

        $this->data['title'] = __('main.title.home');
        $this->data['listCate'] = $listCate;
        $this->data['product'] = $product;
        $this->data['recommendedProducts'] = $recommendedProducts;
        $this->data['product_image_path'] = Config::get('constants.path.upload_image_path');
        $this->data['currency'] = Config::get('constants.default.currency');

        return view('layouts.product.show', $this->data);
    }
}
