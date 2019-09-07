@extends('layouts.master_no_slider_sidebar', ['id' => 'cart_items'])

@section('title') {{ $title }} @endsection

@section('content')
<div class="breadcrumbs">
    <ol class="breadcrumb">
        <li><a href="{{ route('home', app()->getLocale()) }}">Home</a></li>
        <li class="active">Check out success</li>
    </ol>
</div>
<!--/breadcrums-->
<div class="step-one">
    <h2 class="heading">Your order has been processed. Thank you!</h2>
</div>
@endsection
