<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Order;
use App\Models\Order_info;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('user-orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $order = Order::create([
                'user_id' => Auth::user()->id,
                'status' => 'Pending',
            ]);

            for ($i = 0; $i < sizeof($request->item); $i++) {
                Order_info::create([
                    'order_id' => $order->id,
                    'item' => $request->item[$i],
                    'type' => $request->type[$i],
                    'unit' => $request->unit[$i],
                ]);
            }
            return redirect()
                ->route('admin-order.index')
                ->with('success', 'Place Order Successfully');
        } catch (Exception $e) {
            return $e->getMessage();
            return redirect()
                ->route('admin-order.index')
                ->with('failed', 'Request failed');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        
        return view('user-orders.show',[
            'datas'=> Order::with('orderInfo','userData')->where('id',$id)->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
