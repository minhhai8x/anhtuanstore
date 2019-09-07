<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
{
    /**
     * Dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $listBill = DB::table('bills')
            ->leftJoin('customers', 'bills.customer_id', '=', 'customers.id')
            ->orderBy('bills.id', 'desc')->get();
        $this->data['listBill'] = $listBill;
        return view('admin.order.index', $this->data);
    }
}
