<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Model\Product;
use App\Model\Customer;
use App\Model\Bill;
use App\Model\BillDetail;
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
                'qty' => '1',
                'options' => [
                    'image' => Config::get('constants.path.upload_image_path') . '/' . $product->image->image_path,
                ]
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

        return response()->json([
            'qty' => $item->qty,
            'subtotal' => number_format($item->subtotal) . ' ' . $currency,
            'tax' => Cart::tax(),
            'total' => Cart::total()
        ]);
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

        return response()->json([
            'qty' => $item->qty,
            'subtotal' => number_format($item->subtotal) . ' ' . $currency,
            'tax' => Cart::tax(),
            'total' => Cart::total()
        ]);
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

    public function getCheckOut()
    {
        $this->data['title'] = __('main.title.checkout');
        $this->data['cart'] = Cart::content();
        $this->data['total'] = Cart::total();
        $this->data['currency'] = Config::get('constants.default.currency');
        return view('layouts.checkout', $this->data);
    }

    public function postCheckOut(Request $request)
    {
        $cartInfo = Cart::content();
        // validation
        $rule = [
            'customerName' => 'required',
            'customerEmail' => 'required|email',
            'customerAddress' => 'required',
            'customerPhone' => 'required|digits_between:10,12'

        ];
        
        $validator = Validator::make(Input::all(), $rule);
        
        if ($validator->fails()) {
            $locale = app()->getLocale();
            return redirect("/$locale/checkout")->withErrors($validator)->withInput();
        }
        
        try {
            // save
            $customer = new Customer;
            $customer->name = Request::get('customerName');
            $customer->email = Request::get('customerEmail');
            $customer->address = Request::get('customerAddress');
            $customer->phone_number = Request::get('customerPhone');
            $customer->note = Request::get('customerNote');
            $customer->save();

            $bill = new Bill;
            $bill->customer_id = $customer->id;
            $bill->date_order = date('Y-m-d H:i:s');
            $bill->total = floatval(Cart::total());
            $bill->note = Request::get('customerNote');
            $bill->save();

            if (count($cartInfo) >0) {
                foreach ($cartInfo as $key => $item) {
                    $billDetail = new BillDetail;
                    $billDetail->bill_id = $bill->id;
                    $billDetail->product_id = $item->id;
                    $billDetail->quantity = $item->qty;
                    $billDetail->price = $item->price;
                    $billDetail->save();
                }
            }

           Cart::destroy();
            
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return redirect()->route('getCheckOutSuccess');
    }

    public function getCheckOutSuccess()
    {
        $this->data['title'] = __('main.title.checkout_success');
        return view('layouts.checkout_success', $this->data);
    }
}
