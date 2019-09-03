@extends('admin.master')

@section('content')
<section class="content-header">
    <h1>
        Edit Category
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Category</a></li>
        <li class="active">Edit</li>
    </ol>
</section>
<section class="content">
    <form action="{{ url('admincp/category') }}/{{ $category->id }}" method="POST">
        <input type="hidden" name="_method" value="PUT"> {{ csrf_field() }} @if(count($errors) >0)
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
                    <input type="text" name="txtName" class="form-control" value="{{ $category->name }}">
                </div>
                <div class="form-group col-md-12">
                    <label>Slug</label>
                    <input type="text" name="txtSlug" class="form-control" value="{{ $category->slug }}">
                </div>
                <div class="form-group col-md-12">
                    <label>Desc</label>
                    <textarea name="txtDesc" class="form-control">{{ $category->desc }}</textarea>
                </div>
                <div class="form-group col-md-12">
                    <label>Category</label>
                    <select class="form-control" name="parent_id">
                        <option value="0">---</option>
                        @foreach($listCate as $cate)
                        <option value="{{ $cate->id }}" @if ($cate->parent_id == $category->parent_id) selected="selected" @endif >{{ $cate->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <fieldset>
                        <legend>SEO:</legend>
                        SEO Title
                        <input type="text" name="meta_title" class="form-control" value="{{ $category->meta_title }}"> Meta Keywords
                        <input type="text" name="meta_keywords" class="form-control" value="{{ $category->meta_keywords }}"> Meta Description
                        <input type="text" name="meta_description" class="form-control" value="{{ $category->meta_description }}">
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
