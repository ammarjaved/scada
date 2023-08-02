<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Order;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class adminOrderController extends Controller
{
    //

    public function index()
    {
        if (Auth::user()->type === true) {
            return view('order.index', [
                'datas' => Order::withCount('orderInfo')
                    ->with('userData')
                    ->where('status', 'Pending')
                    ->get(),
            ]);
        } else {
            return view('order.index', [
                'datas' => Order::withCount('orderInfo')
                    ->with('userData')
                    ->where('status', 'Pending')
                    ->where('user_id', Auth::user()->id)
                    ->get(),
            ]);
        }
    }

    public function completeOrder($id)
    {
        try {
            Order::find($id)->update(['status' => 'Complete']);

            return Redirect::route('admin-order.index')->with('success', 'Order Complete Successfully');
        } catch (Exception $e) {
            return $e->getMessage();
            return Redirect::route('admin-order.index')->with('failed', 'Request failed');
        }
    }

    public function getCOmpleteOrders()
    {
        if (Auth::user()->type === true) {
        return view('order.completeOrders', [
            'datas' => Order::withCount('orderInfo')
                ->with('userData')
                ->where('status', 'Complete')
                ->get(),
        ]);
    }else{
        return view('order.completeOrders', [
            'datas' => Order::withCount('orderInfo')
                ->with('userData')
                ->where('status', 'Complete')->where('user_id',Auth::user()->id)
                ->get(),
        ]);
    }
    }
}
