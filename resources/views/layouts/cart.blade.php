@extends('layouts.master_no_slider_sidebar', ['id' => 'cart_items'])

@section('title') {{ $title }} @endsection

@section('content')
<div class="breadcrumbs">
    <ol class="breadcrumb">
        <li><a href="{{ route('home', app()->getLocale()) }}">Home</a></li>
        <li class="active">Shopping Cart</li>
    </ol>
</div>
@if (isset($cart) && count($cart) > 0)
<div class="table-responsive cart_info">
    <table class="table table-condensed">
        <thead>
            <tr class="cart_menu">
                <td class="image">Item</td>
                <td class="description"></td>
                <td class="price">Price</td>
                <td class="quantity">Quantity</td>
                <td class="total">Total</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $item)
            <tr>
                <td class="cart_product">
                    @if (isset($item->options))
                    <a href="{{ route('getProductDetail', ['locale' => app()->getLocale(), 'pid' => $item->id]) }}"><img class="cart-product-thumb" src="/{{ $item->options->image }}" alt="{{ $item->name }}"></a>
                    @else
                    <a href="{{ route('getProductDetail', ['locale' => app()->getLocale(), 'pid' => $item->id]) }}"><img src="{{ asset('images/no_image.png') }}" alt="{{ $item->name }}" /></a>
                    @endif
                </td>
                <td class="cart_description">
                    <h4><a href="{{ route('getProductDetail', ['locale' => app()->getLocale(), 'pid' => $item->id]) }}">{{ $item->name }}</a></h4>
                </td>
                <td class="cart_price">
                    <p>{{ number_format($item->price) }} {{ $currency }}</p>
                </td>
                <td class="cart_quantity">
                    <div class="cart_quantity_button">
                        <a class="cart_quantity_up" data-pid="{{ $item->id }}" data-url="{{ route('getCartIncreaseQty', app()->getLocale()) }}"> + </a>
                        <input class="cart_quantity_input" type="text" name="quantity" value="{{ $item->qty }}" autocomplete="off" size="2">
                        <a class="cart_quantity_down" data-pid="{{ $item->id }}" data-url="{{ route('getCartDecreaseQty', app()->getLocale()) }}"> - </a>
                    </div>
                </td>
                <td class="cart_total">
                    <p class="cart_total_price">{{ number_format($item->subtotal) }} {{ $currency }}</p>
                </td>
                <td class="cart_delete">
                    <a class="cart_quantity_delete" data-pid="{{ $item->id }}" data-url="{{ route('getCartRemoveItem', app()->getLocale()) }}" data-callback-url="{{ route('getCart', app()->getLocale()) }}"><i class="fa fa-times"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="row text-right">
    <div class="col-sm-12">
        <div class="total_area">
            <a class="btn btn-default check_out" href="{{ route('getCheckOut', app()->getLocale()) }}">Check Out &gt;</a>
        </div>
    </div>
    <span>&nbsp;</span>
</div>
@else
<div class="heading">
    <h3>Oops!</h3>
    <p>You have no items in the shopping cart</p>
</div>
@endif
@endsection

@section('page-js-script')
    <script>
        $('.cart_quantity_up').click(function (e) {
            e.preventDefault();
            var parent = $(this).parents('tr');
            var updateQtyUrl = $(this).data('url');
            var updateQtyPid = $(this).data('pid');
            $.ajax({
                type: "GET",
                url: updateQtyUrl,
                data: {pid: updateQtyPid},
                success: function(response) {
                    parent.find('.cart_quantity_input').val(response['qty']);
                    parent.find('.cart_total_price').html(response['subtotal']);
                } 
            });
        });

        $('.cart_quantity_down').click(function (e) {
            e.preventDefault();
            var parent = $(this).parents('tr');
            var updateQtyUrl = $(this).data('url');
            var updateQtyPid = $(this).data('pid');
            $.ajax({
                type: "GET",
                url: updateQtyUrl,
                data: {pid: updateQtyPid},
                success: function(response) {
                    parent.find('.cart_quantity_input').val(response['qty']);
                    parent.find('.cart_total_price').html(response['subtotal']);
                } 
            });
        });

        $('.cart_quantity_delete').click(function (e) {
            e.preventDefault();
            var updateQtyUrl = $(this).data('url');
            var updateQtyPid = $(this).data('pid');
            var callbackUrl = $(this).data('callback-url');
            $.ajax({
                type: "GET",
                url: updateQtyUrl,
                data: {pid: updateQtyPid},
                success: function(response) {
                    window.location.href = callbackUrl;
                }
            });
        });
    </script>
@endsection
