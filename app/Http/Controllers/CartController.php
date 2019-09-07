<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Config;
use App\Model\Product;
use Cart;

class CartController extends Controller
{
    
    public function cart()
    {
        $this->data['title'] = __('main.title.cart');
        if (Request::isMethod('post')) {
            $product_id = Request::get('product_id');
            $product = Product::find($product_id);
            $cartInfo = [
                'id' => $product_id,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => '1'
            ];
            Cart::add($cartInfo);
        }

        $cart = Cart::content();
        $this->data['cart'] = $cart;
        $this->data['currency'] = Config::get('constants.default.currency');

        return view('layouts.cart', $this->data);
    }

    public function increaseQuantity()
    {
        $rows = Cart::search(function($key, $value) {
            return $key->id == Request::get('pid');
        });
        $item = $rows->first();

        Cart::update($item->rowId, $item->qty + 1);
        $currency = Config::get('constants.default.currency');

        return response()->json(['qty' => $item->qty, 'subtotal' => number_format($item->subtotal) . ' ' . $currency]);
    }

    public function decreaseQuantity()
    {
        $rows = Cart::search(function($key, $value) {
            return $key->id == Request::get('pid');
        });
        $item = $rows->first();
        if ($item->qty > 1) {
            Cart::update($item->rowId, $item->qty - 1);
        }
        $currency = Config::get('constants.default.currency');

        return response()->json(['qty' => $item->qty, 'subtotal' => number_format($item->subtotal) . ' ' . $currency]);
    }

    public function removeItem()
    {
        $rows = Cart::search(function($key, $value) {
            return $key->id == Request::get('pid');
        });
        $rowId = $rows->first()->rowId;

        Cart::remove($rowId);
        return response()->json(['status' => true]);
    }
}
