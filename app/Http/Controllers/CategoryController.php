<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class CategoryController extends Controller
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
     * Show products in category
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($locale, $cid)
    {
        $listProduct = DB::table('products')
            ->leftJoin('product_images', 'products.id', '=', 'product_images.product_id')
            ->where('products.category_id', $cid)
            ->orderBy('products.created_at', 'desc')
            ->paginate(Config::get('constants.records_per_page.products_in_category'));
        $listCate = DB::table('categories')
            ->orderBy('id','desc')->get();
        $this->data['title'] = __('main.title.category');
        $this->data['listCate'] = $listCate;
        $this->data['listProduct'] = $listProduct;
        $this->data['product_image_path'] = Config::get('constants.path.upload_image_path');
        $this->data['currency'] = Config::get('constants.default.currency');

        return view('layouts.category', $this->data);
    }
}
