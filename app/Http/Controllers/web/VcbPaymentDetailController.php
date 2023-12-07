<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VcbPaymentDetailModel;
use Exception;
use App\Models\VcbAeroSpendModel;

class VcbPaymentDetailController extends Controller
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
            $data = VcbAeroSpendModel::find($request->p_id);
            if ($data) {

                $request['vcb_id'] = $request->p_id;
                VcbPaymentDetailModel::create($request->all());
                $this->updatePayments($request->p_id);


            }
            return response()->json(['success' => true, 'id' => $data->id_vcb_budget], 200);
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


        $res_data = [];
        try {
            $payment_detail = VcbPaymentDetailModel::find($id);
                // get payment detail recored and check if exist
            if ($payment_detail) {

                $payment_detail->update($request->all());

                    $this->updatePayments($payment_detail->vcb_id);

                    $data = VcbAeroSpendModel::find($payment_detail->vcb_id); // get spend table recored
                $nameTotal =$data->{$request->pmt_name};

            } else {
                return response()->json(['success' => false, 'message' => 'something is wrong'], 200);
            }
            $res_data['sub_total'] = $data->total;
            $res_data['total'] = $nameTotal;
            $res_data['name'] = $request->inp_name;
            $res_data['pending_payment'] = $data->pending_payment;
            $res_data['outstanding'] = $data->outstanding_balance;


            return response()->json(['success' => true, 'id' => $data->id_vcb_budget, 'data' => $res_data], 200);
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
            $data = VcbPaymentDetailModel::find($id);
            if ($data) {
                $data->delete();
                $this->updatePayments($data->vcb_id);



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



        VcbAeroSpendModel::where('id', $id)
        ->update([
            'amt_transducer' => VcbPaymentDetailModel::where('pmt_name', 'amt_transducer')->where('vcb_id',$id)->sum('amount'),
            'amt_transducer_status' =>VcbPaymentDetailModel::where('pmt_name', 'amt_transducer')->where('vcb_id',$id)->latest('created_at')->value('status'),

            'amt_bo' => VcbPaymentDetailModel::where('pmt_name', 'amt_bo')->where('vcb_id',$id)->sum('amount'),
            'amt_bo_status' =>VcbPaymentDetailModel::where('pmt_name', 'amt_bo')->where('vcb_id',$id)->latest('created_at')->value('status'),

            'amt_rtu' => VcbPaymentDetailModel::where('pmt_name', 'amt_rtu')->where('vcb_id',$id)->sum('amount'),
            'amt_rtu_status' =>VcbPaymentDetailModel::where('pmt_name', 'amt_rtu')->where('vcb_id',$id)->latest('created_at')->value('status'),

            'amt_cable'=> VcbPaymentDetailModel::where('pmt_name', 'amt_cable')->where('vcb_id',$id)->sum('amount'),
            'amt_cable_status' =>VcbPaymentDetailModel::where('pmt_name', 'amt_cable')->where('vcb_id',$id)->latest('created_at')->value('status'),



            'amt_transport'=> VcbPaymentDetailModel::where('pmt_name', 'amt_transport')->where('vcb_id',$id)->sum('amount'),
            'amt_transport_status' =>VcbPaymentDetailModel::where('pmt_name', 'amt_transport')->where('vcb_id',$id)->latest('created_at')->value('status'),

            'amt_store_rental'=> VcbPaymentDetailModel::where('pmt_name', 'amt_store_rental')->where('vcb_id',$id)->sum('amount'),
            'amt_store_rental_status' =>VcbPaymentDetailModel::where('pmt_name', 'amt_store_rental')->where('vcb_id',$id)->latest('created_at')->value('status'),

            'tools'=>VcbPaymentDetailModel::where('pmt_name', 'tools')->where('vcb_id',$id)->sum('amount'),
            'amt_tools_status' =>VcbPaymentDetailModel::where('pmt_name', 'tools')->where('vcb_id',$id)->latest('created_at')->value('status'),

            'amt_rtu_cable'=> VcbPaymentDetailModel::where('pmt_name', 'amt_rtu_cable')->where('vcb_id',$id)->sum('amount'),
            'amt_rtu_cable_status' =>VcbPaymentDetailModel::where('pmt_name', 'amt_rtu_cable')->where('vcb_id',$id)->latest('created_at')->value('status'),
            'total'=>VcbPaymentDetailModel::where('status','!=', 'not work done and  not payed')->where('vcb_id',$id)->where('status','!=', 'work done but not payed')->sum('amount'),
            'pending_payment'=>VcbPaymentDetailModel::where('status',  'not work done and  not payed')->where('vcb_id',$id)->sum('amount'),
            'outstanding_balance'=>VcbPaymentDetailModel::where('status', 'work done but not payed')->where('vcb_id',$id)->sum('amount'),

    ]);
    }
}
