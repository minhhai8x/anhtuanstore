@extends('admin.master')

@section('content')
<section class="content-header">
    <h1>
        Edit Product
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Product</a></li>
        <li class="active">Edit</li>
    </ol>
</section>
<section class="content">
    <form action="{{ url('admincp/product') }}/{{ $product->id }}" method="POST">
        <input type="hidden" name="_method" value="PUT"> {{ csrf_field() }} @if(count($errors) > 0)
        <ul>
            @foreach($errors->all() as $error)
            <li class="text-danger">{{ $error }}</li>
            @endforeach
        </ul>
        @endif
        <div class="box">
            <div class="box-body row">
                <div class="form-group col-md-12">
                    <label>Name</label>
                    <input type="text" name="txtName" class="form-control" value="{{ $product->name }}">
                </div>
                <div class="form-group col-md-12">
                    <label>Slug</label>
                    <input type="text" name="txtSlug" class="form-control" value="{{ $product->slug }}">
                </div>
                <div class="form-group col-md-12">
                    <label>Price</label>
                    <input type="text" name="txtPrice" class="form-control" value="{{ $product->price }}">
                </div>
                <div class="form-group col-md-12">
                    <label>Desc</label>
                    <textarea name="txtDesc" class="form-control">{{ $product->desc }}</textarea>
                </div>
                <div class="form-group col-md-12">
                    <label>Category</label>
                    <select class="form-control" name="category_id">
                        <option value="0">---</option>
                        @foreach($listCate as $cate)
                        <option value="{{ $cate->id }}" @if ($cate->id == $product->category_id) selected="selected" @endif >{{ $cate->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>Thumbnail</label>
                    <img id="preview_image" src="/{{ $product_image_path }}/{{ $product->image->image_path }}"/>
                    <input type="file" id="product_image" name="productImage" />
                </div>
                <div class="form-group col-md-12">
                    <div id="btn_change_file" class="btn btn-primary">
                        <i class="fa fa-edit"></i>
                        <span>Change</span>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <fieldset>
                        <legend>SEO:</legend>
                        SEO Title
                        <input type="text" name="meta_title" class="form-control" value="{{ $product->meta_title }}"> Meta Keywords
                        <input type="text" name="meta_keywords" class="form-control" value="{{ $product->meta_keywords }}"> Meta Description
                        <input type="text" name="meta_description" class="form-control" value="{{ $product->meta_description }}">
                    </fieldset>

                </div>
            </div>
            <div class="box-footer row">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-save"></i>
                    <span>Save and back</span>
                </button>
            </div>
        </div>
    </form>
</section>
@endsection
