@extends('layouts.master_no_slider')

@section('title') {{ $title }} @endsection

@section('content')
<div class="product-details">
    <!--product-details-->
    <div class="col-sm-5">
        <div class="view-product">
            <img src="/{{ $product_image_path }}/{{ $product->image->image_path }}" alt="{{ $product->name }}"/>
        </div>
    </div>
    <div class="col-sm-7">
        <div class="product-information">
            <!--/product-information-->
            <img src="{{ asset('layouts/images/product-details/new.jpg') }}" class="newarrival" alt="New arrival" />
            <h2>{{ $product->name }}</h2>
            <span>
                <span>{{ number_format($product->price) }} {{ $currency }}</span>
                <span><img src="{{ asset('layouts/images/product-details/rating.png') }}" alt="Rating" /></span>
            </span>
            <span>
                <label>Quantity:</label>
                <input type="text" value="1" />
                <button type="button" class="btn btn-fefault cart">
                    <i class="fa fa-shopping-cart"></i> {{ __('main.buttons.add_to_cart') }}
                </button>
            </span>
            <p><b>Availability:</b> In Stock</p>
            <p><b>Condition:</b> New</p>
            <p><b>Brand:</b> E-SHOPPER</p>
        </div>
        <!--/product-information-->
    </div>
</div>
<!--/product-details-->

<div class="category-tab shop-details-tab">
    <!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#reviews" data-toggle="tab">Details</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="reviews">
            <div class="col-sm-12">
                <ul>
                    <li><a><i class="fa fa-user"></i>EUGEN</a></li>
                    <li><a><i class="fa fa-clock-o"></i>{{ $product->created_at->format('G:i A') }}</a></li>
                    <li><a><i class="fa fa-calendar-o"></i>{{ $product->created_at->format('d M Y') }}</a></li>
                </ul>
                {!! $product->desc !!}
            </div>
        </div>

    </div>
</div>
<!--/category-tab-->

@if (isset($recommendedProducts) && count($recommendedProducts) > 0)
<div class="recommended_items">
    <!--recommended_items-->
    <h2 class="title text-center">recommended items</h2>

    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach($recommendedProducts as $item)
            <div class="item active">
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="/{{ $product_image_path }}/{{ $item->image_path }}" alt="{{ $item->name }}"/>
                                <h2>{{ number_format($item->price) }} {{ $currency }}</h2>
                                <p><a href="{{ route('getProductDetail', ['locale' => app()->getLocale(), 'pid' => $item->id]) }}">{{ $item->name }}</a></p>
                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>{{ __('main.buttons.add_to_cart') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!--/recommended_items-->
@endif

@endsection
