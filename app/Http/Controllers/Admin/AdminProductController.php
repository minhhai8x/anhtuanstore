<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
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

            if ($product->save()) {
                if ($request->hasFile('productImage')) {
                    $imageFile = $request->file('productImage');
                    $destinationPath = base_path() . '/public/' . Config::get('constants.path.upload_image_path');

                    if ($imageFile->isValid()) {
                        $destinationFileName = time() . '_' . $imageFile->getClientOriginalName();
                        $imageFile->move($destinationPath, $destinationFileName);
                        $productImage = new ProductImage;
                        $productImage->image_path = $destinationFileName;
                        $productImage->title = $imageFile->getClientOriginalName();
                        $productImage->alt = $imageFile->getClientOriginalName();
                        $productImage->product_id = $product->id;
                        $productImage->save();
                    }
                }
                Session::flash('message', "Successfully created product");
                return Redirect::to('admincp/product');
            } else {
                return Redirect::to('admincp/product/create');
            }
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
        $this->data['product_image_path'] = Config::get('constants.path.upload_image_path');
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

            if ($product->save()) {
                if ($request->hasFile('productImage')) {
                    $imageFile = $request->file('productImage');
                    $destinationPath = base_path() . '/public/' . Config::get('constants.path.upload_image_path');

                    if ($imageFile->isValid()) {
                        $destinationFileName = time() . '_' . $imageFile->getClientOriginalName();
                        $imageFile->move($destinationPath, $destinationFileName);
                        $product->image->image_path = $destinationFileName;
                        $product->image->title = $imageFile->getClientOriginalName();
                        $product->image->alt = $imageFile->getClientOriginalName();
                        $product->image->save();
                    }
                }
                Session::flash('message', "Successfully edited product");
                return Redirect::to('admincp/product');
            } else {
                return Redirect::to('admincp/product/create');
            }
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
        if ($product->delete()) {
            $product->image()->delete();
        }
        Session::flash('message', "Successfully delete product");
        return Redirect::to('admincp/product');
    }
}
