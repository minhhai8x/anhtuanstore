@extends('layouts.master_no_slider_sidebar', ['id' => 'cart_items'])

@section('title') {{ $title }} @endsection

@section('content')
<div class="breadcrumbs">
    <ol class="breadcrumb">
        <li><a href="{{ route('home', app()->getLocale()) }}">Home</a></li>
        <li class="active">Check out</li>
    </ol>
</div>
<!--/breadcrums-->
<form action="{{ route('postCheckOut', app()->getLocale()) }}" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="shopper-informations">
        <div class="row">
            <div class="col-sm-5 clearfix">
                <div class="bill-to">
                    <p>Customer informations</p>
                    @if(count($errors) >0)
                        <ul>
                            @foreach($errors->all() as $error)
                                <li class="text-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-one">
                        <input class="custom-input-form" name="customerName" type="text" placeholder="Customer Name*">
                        <input class="custom-input-form" name="customerEmail" type="text" placeholder="Email*">
                        <input class="custom-input-form" name="customerAddress" type="text" placeholder="Address*">
                    </div>
                    <div class="form-two">
                        <input class="custom-input-form" name="customerPhone" type="text" placeholder="Phone *">
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="order-message">
                    <p>Note</p>
                    <textarea name="customerNote" placeholder="Notes about your order, Special Notes for Delivery" rows="10"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="shopper-informations">
        <div class="row">
            <div class="col-sm-12">
                <div class="shopper-info">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <a class="btn btn-primary" href="{{ route('home', app()->getLocale()) }}"> < Back to Home</a>
                    <button type="submit" class="btn btn-primary">Proceed to purchase > </button>
                </div>
            </div>
        </div>
        <div class="row">&nbsp;</div>
    </div>
</form>
<div class="review-payment">
    <h2>Review & Payment</h2>
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
            <tr>
                <td colspan="4">&nbsp;</td>
                <td colspan="2">
                    <table class="table table-condensed total-result">
                        <tr>
                            <td>Tax(5%)</td>
                            <td id="cart-tax">{{ number_format($item->tax) }} {{ $currency }}</td>
                        </tr>
                        <tr class="shipping-cost">
                            <td>Shipping Cost</td>
                            <td>Free</td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td><span id="cart-total">{{ $total }} {{ $currency }}</span></td>
                        </tr>
                        <input type="hidden" name="hid_currency" id="hid_currency" value="{{ $currency }}">
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
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
                    $('#cart-tax').html(response['tax'] + ' ' + $('#hid_currency').val());
                    $('#cart-total').html(response['total'] + ' ' + $('#hid_currency').val());
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
                    $('#cart-tax').html(response['tax'] + ' ' + $('#hid_currency').val());
                    $('#cart-total').html(response['total'] + ' ' + $('#hid_currency').val());
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
