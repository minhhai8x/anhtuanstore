<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Model\ProductImage;
use App\Model\Product;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['title'] = 'List Product';
        $listProduct = DB::table('products')
            ->orderBy('id', 'desc')
            ->paginate(10);
        $this->data['listProduct'] = $listProduct;
        return view('admin.product.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['title'] = "Add Product";
        $listCate = DB::table('categories')
            ->orderBy('id','desc')->get();
        $this->data['listCate'] = $listCate;
        return view('admin.product.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule = [
            'txtName' => 'required'
        ];
        $validator = Validator::make(Input::all(), $rule);
        if ($validator->fails()) {
            return Redirect::to('admincp/product/create')
                ->withErrors($validator);
        } else {
            $product = new Product;
            $product->category_id = Input::get('category_id');
            $product->name = Input::get('txtName');
            $product->desc = Input::get('txtDesc');
            $product->slug = Input::get('txtSlug');
            $product->price = Input::get('txtPrice');
            $product->meta_title = Input::get('meta_title');
            $product->meta_keywords = Input::get('meta_keywords');
            $product->meta_description = Input::get('meta_description');
            $product->save();
            Session::flash('message', "Successfully created product");
            return Redirect::to('admincp/product');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $this->data['title'] = 'Edit Product';
        $this->data['product'] = $product;
        $listCate = DB::table('categories')
            ->orderBy('id','desc')->get();
        $this->data['listCate'] = $listCate;
        return view('admin.product.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rule = [
            'txtName' => 'required'
        ];
        $validator = Validator::make(Input::all(), $rule);
        if ($validator->fails()) {
            return Redirect::to('admincp/product/' . $id . '/edit')
                ->withErrors($validator);
        } else {
            $product = Product::find($id);
            $product->category_id = Input::get('category_id');
            $product->name = Input::get('txtName');
            $product->slug = Input::get('txtSlug');
            $product->price = Input::get('txtPrice');
            $product->desc = Input::get('txtDesc');
            $product->meta_title = Input::get('meta_title');
            $product->meta_keywords = Input::get('meta_keywords');
            $product->meta_description = Input::get('meta_description');
            $product->save();
            Session::flash('message', "Successfully edited product");
            return Redirect::to('admincp/product');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        Session::flash('message', "Successfully delete product");
        return Redirect::to('admincp/product');
    }
}
