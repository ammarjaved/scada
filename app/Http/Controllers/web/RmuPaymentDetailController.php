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
            $data = RmuAeroSpendModel::find($request->p_id);
            if ($data) {

                $request['rmu_id'] = $request->p_id;
                RmuPaymentDetailModel::create($request->all());
                $this->updatePayments($request->p_id);


            }
            return response()->json(['success' => true, 'id' => $data->id_rmu_budget], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'error' => $th->getMessage()], 200);
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

        $res_data = [];
        try {
            $payment_detail = RmuPaymentDetailModel::find($id);
                // get payment detail recored and check if exist
            if ($payment_detail) {

                $payment_detail->update($request->all());

                    $this->updatePayments($payment_detail->rmu_id);

                    $data = RmuAeroSpendModel::find($payment_detail->rmu_id); // get spend table recored
                $nameTotal =$data->{$request->pmt_name};

            } else {
                return response()->json(['success' => false, 'message' => 'something is wrong'], 200);
            }
            $res_data['sub_total'] = $data->total;
            $res_data['total'] = $nameTotal;
            $res_data['name'] = $request->inp_name;
            $res_data['pending_payment'] = $data->pending_payment;
            $res_data['outstanding'] = $data->outstanding_balance;


            return response()->json(['success' => true, 'id' => $data->id_rmu_budget, 'data' => $res_data], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'error' => $th->getMessage()], 500);
        }
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
            $data = RmuPaymentDetailModel::find($id);
            if ($data) {
                $data->delete();
                $this->updatePayments($data->rmu_id);



            } else {
                return  redirect()->back()->with('failed','Request Success');
            }
            return redirect()->back()->with('success','Request Success');
        } catch (\Throwable $th) {
            // return $th->getMessage();
            return  redirect()->back()->with('failed','Request Success');
        }
    }

    public function updatePayments($id)
    {

        RmuAeroSpendModel::where('id', $id)
        ->update([
            'amt_kkb' =>RmuPaymentDetailModel::where('pmt_name', 'amt_kkb')->sum('amount'),
            'amt_kkb_status' =>RmuPaymentDetailModel::where('pmt_name', 'amt_kkb')->latest('created_at')->value('status'),

            'amt_ir' => RmuPaymentDetailModel::where('pmt_name', 'amt_ir')->sum('amount'),
            'amt_ir_status' =>RmuPaymentDetailModel::where('pmt_name', 'amt_ir')->latest('created_at')->value('status'),

            'amt_bo' => RmuPaymentDetailModel::where('pmt_name', 'amt_bo')->sum('amount'),
            'amt_bo_status' =>RmuPaymentDetailModel::where('pmt_name', 'amt_bo')->latest('created_at')->value('status'),

            'amt_rtu' => RmuPaymentDetailModel::where('pmt_name', 'amt_rtu')->sum('amount'),
            'amt_rtu_status' =>RmuPaymentDetailModel::where('pmt_name', 'amt_rtu')->latest('created_at')->value('status'),

            'amt_cable'=> RmuPaymentDetailModel::where('pmt_name', 'amt_cable')->sum('amount'),
            'amt_cable_status' =>RmuPaymentDetailModel::where('pmt_name', 'amt_cable')->latest('created_at')->value('status'),

            'amt_piw' => RmuPaymentDetailModel::where('pmt_name', 'amt_piw')->sum('amount'),
            'amt_piw_status' =>RmuPaymentDetailModel::where('pmt_name', 'amt_piw')->latest('created_at')->value('status'),

            'amt_pk'=> RmuPaymentDetailModel::where('pmt_name', 'amt_pk')->sum('amount'),
            'amt_pk_status' =>RmuPaymentDetailModel::where('pmt_name', 'amt_pk')->latest('created_at')->value('status'),

            'amt_transport'=> RmuPaymentDetailModel::where('pmt_name', 'amt_transport')->sum('amount'),
            'amt_transport_status' =>RmuPaymentDetailModel::where('pmt_name', 'amt_transport')->latest('created_at')->value('status'),

            'amt_store_rental'=> RmuPaymentDetailModel::where('pmt_name', 'amt_store_rental')->sum('amount'),
            'amt_store_rental_status' =>RmuPaymentDetailModel::where('pmt_name', 'amt_store_rental')->latest('created_at')->value('status'),

            'tools'=>RmuPaymentDetailModel::where('pmt_name', 'tools')->sum('amount'),
            'amt_tools_status' =>RmuPaymentDetailModel::where('pmt_name', 'tools')->latest('created_at')->value('status'),

            'amt_rtu_cable'=> RmuPaymentDetailModel::where('pmt_name', 'amt_rtu_cable')->sum('amount'),
            'amt_rtu_cable_status' =>RmuPaymentDetailModel::where('pmt_name', 'amt_rtu_cable')->latest('created_at')->value('status'),
            'total'=>RmuPaymentDetailModel::where('status','!=', 'not work done and  not payed')->where('status','!=', 'work done but not payed')->sum('amount'),
            'pending_payment'=>RmuPaymentDetailModel::where('status',  'not work done and  not payed')->sum('amount'),
            'outstanding_balance'=>RmuPaymentDetailModel::where('status', 'work done but not payed')->sum('amount'),

    ]);
    }
}
