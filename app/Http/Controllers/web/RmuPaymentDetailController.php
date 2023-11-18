<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RmuPaymentDetailModel;
use App\Models\RmuAeroSpendModel;



class RmuPaymentDetailController extends Controller
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

            $data =  RmuAeroSpendModel::find($request->id);
            if ($data) {
                $total = $data->total + $request->amount;
                $name  = $request->pmt_name;
                $nameTotal = $data->$name + $request->amount;
                $data->update(['total'=>$total, $name => $nameTotal]);
            RmuPaymentDetailModel::create([
                'pmt_name'      => $request->pmt_name,
                'amount'        => $request->amount,
                'status'        => $request->status,
                'description'   => $request->description,
                'rmu_id'        => $request->id,
            ]);
         }
            return response()->json(['success'=>true, 'id'=>$data->id_rmu_budget], 200);

        } catch (\Throwable $th) {
            return response()->json(['success'=>false, 'error'=>$th->getMessage()], 200);
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
        //
    }
}
