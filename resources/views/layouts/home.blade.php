@extends('layouts.master')

@section('title') {{ $title }} @endsection

@section('content')

<div class="features_items">
    <!-- features_items -->
    <h2 class="title text-center">{{ __('main.title.new_products') }}</h2>

    @if (isset($listProduct) && count($listProduct) > 0) @foreach($listProduct as $product)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    @if (isset($product->image_path))
                    <img src="/{{ $product_image_path }}/{{ $product->image_path }}" alt="{{ $product->name }}" />
                    @else
                    <img src="{{ asset('images/no_image.png') }}" alt="{{ $product->name }}" />
                    @endif
                    <h2>{{ number_format($product->price) }} {{ $currency }}</h2>
                    <p>{{ $product->name }}</p>
                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>{{ __('main.buttons.add_to_cart') }}</a>
                </div>
                <div class="product-overlay">
                    <div class="overlay-content">
                        <h2>{{ number_format($product->price) }} {{ $currency }}</h2>
                        <p><a href="{{ route('getProductDetail', ['locale' => app()->getLocale(), 'pid' => $product->id]) }}">{{ $product->name }}</a></p>
                        <form method="POST" action="{{ route('postCart', app()->getLocale()) }}">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-fefault add-to-cart">
                                <i class="fa fa-shopping-cart"></i>{{ __('main.buttons.add_to_cart') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach @endif
</div>
<!-- /features_items -->
@endsection
