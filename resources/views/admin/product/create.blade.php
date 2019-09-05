@extends('admin.master')

@section('content')
<section class="content-header">
    <h1>
        Add Product
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Product</a></li>
        <li class="active">Add</li>
    </ol>
</section>
<section class="content">
    <form action="{{ url('admincp/product') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }} @if(count($errors) > 0)
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
                    <input type="text" name="txtName" class="form-control" value="{{ old('txtName') }}">
                </div>
                <div class="form-group col-md-12">
                    <label>Slug</label>
                    <input type="text" name="txtSlug" class="form-control" value="{{ old('txtSlug') }}">
                </div>
                <div class="form-group col-md-12">
                    <label>Price</label>
                    <input type="text" name="txtPrice" class="form-control" value="{{ old('txtPrice') }}">
                </div>
                <div class="form-group col-md-12">
                    <label>Desc</label>
                    <textarea id="txtDesc" name="txtDesc" class="form-control">{{ old('txtDesc') }}</textarea>
                </div>
                <div class="form-group col-md-12">
                    <label>Category</label>
                    <select class="form-control" name="category_id" value="{{ old('category_id') }}">
                        <option value="0">---</option>
                        @foreach($listCate as $cate)
                        <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>Thumbnail</label>
                    <img id="preview_image" src="{{ asset('images/no_image.png') }}"/>
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
                        <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title') }}"> Meta Keywords
                        <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords') }}"> Meta Description
                        <input type="text" name="meta_description" class="form-control" value="{{ old('meta_description') }}">
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

@section('page-js-script')
    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script>
      $(function () {
        CKEDITOR.replace('txtDesc');
      })
    </script>
@endsection
