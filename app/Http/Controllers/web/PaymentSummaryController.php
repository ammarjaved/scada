<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentSummaryModel;

class PaymentSummaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return view('PaymentSummary.index', ['datas' => PaymentSummaryModel::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {

            PaymentSummaryModel::create($request->all());
            return redirect()->route('payment-summary-details.index')->with('success',"Payment Added");
        } catch (\Throwable $th) {
            return $th->getMessage();
            return redirect()->route('payment-summary-details.index')->with('failed',"Request Failed");
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
        try {

            PaymentSummaryModel::find($id)->delete();
            return redirect()->route('payment-summary-details.index')->with('success',"Recored Removed");
        } catch (\Throwable $th) {
            return $th->getMessage();
            return redirect()->route('payment-summary-details.index')->with('failed',"Request Failed");
        }
    }
}
