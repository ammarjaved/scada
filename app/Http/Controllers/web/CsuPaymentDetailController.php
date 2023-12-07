<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CsuPaymentDetailModel;
use Exception;
use App\Models\CsuAeroSpendModel;

class CsuPaymentDetailController extends Controller
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
            $data = CsuAeroSpendModel::find($request->p_id);
            if ($data) {

                $request['csu_id'] = $request->p_id;
                CsuPaymentDetailModel::create($request->all());
                $this->updatePayments($request->p_id);


            }
            return response()->json(['success' => true, 'id' => $data->id_csu_budget], 200);
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
            $payment_detail = CsuPaymentDetailModel::find($id);
                // get payment detail recored and check if exist
            if ($payment_detail) {

                $payment_detail->update($request->all());

                    $this->updatePayments($payment_detail->csu_id);

                    $data = CsuAeroSpendModel::find($payment_detail->csu_id); // get spend table recored
                $nameTotal =$data->{$request->pmt_name};

            } else {
                return response()->json(['success' => false, 'message' => 'something is wrong'], 200);
            }
            $res_data['sub_total'] = $data->total;
            $res_data['total'] = $nameTotal;
            $res_data['name'] = $request->inp_name;
            $res_data['pending_payment'] = $data->pending_payment;
            $res_data['outstanding'] = $data->outstanding_balance;


            return response()->json(['success' => true, 'id' => $data->id_csu_budget, 'data' => $res_data], 200);
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
        //


        try {
            $data = CsuPaymentDetailModel::find($id);
            if ($data) {
                $data->delete();
                $this->updatePayments($data->csu_id);



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


        CsuAeroSpendModel::where('id',$id)
        ->update([
            'amt_kkb' =>CsuPaymentDetailModel::where('pmt_name', 'amt_kkb')->where('csu_id',$id)->sum('amount'),
            'amt_kkb_status' =>CsuPaymentDetailModel::where('pmt_name', 'amt_kkb')->where('csu_id',$id)->latest('created_at')->value('status'),

            'amt_cfs' => CsuPaymentDetailModel::where('pmt_name', 'amt_cfs')->where('csu_id',$id)->sum('amount'),
            'amt_cfs_status' =>CsuPaymentDetailModel::where('pmt_name', 'amt_cfs')->where('csu_id',$id)->latest('created_at')->value('status'),

            'amt_bo' => CsuPaymentDetailModel::where('pmt_name', 'amt_bo')->where('csu_id',$id)->sum('amount'),
            'amt_bo_status' =>CsuPaymentDetailModel::where('pmt_name', 'amt_bo')->where('csu_id',$id)->latest('created_at')->value('status'),

            'amt_rtu' => CsuPaymentDetailModel::where('pmt_name', 'amt_rtu')->where('csu_id',$id)->where('csu_id',$id)->sum('amount'),
            'amt_rtu_status' =>CsuPaymentDetailModel::where('pmt_name', 'amt_rtu')->where('csu_id',$id)->latest('created_at')->value('status'),


            'amt_store_rental' => CsuPaymentDetailModel::where('pmt_name', 'amt_store_rental')->where('csu_id',$id)->sum('amount'),
            'amt_store_rental_status' =>CsuPaymentDetailModel::where('pmt_name', 'amt_store_rental')->where('csu_id',$id)->latest('created_at')->value('status'),



            'amt_transport' => CsuPaymentDetailModel::where('pmt_name', 'amt_transport')->where('csu_id',$id)->sum('amount'),
            'amt_transport_status' =>CsuPaymentDetailModel::where('pmt_name', 'amt_transport')->where('csu_id',$id)->latest('created_at')->value('status'),



            'tools'=>CsuPaymentDetailModel::where('pmt_name', 'tools')->where('csu_id',$id)->sum('amount'),
            'amt_tools_status' =>CsuPaymentDetailModel::where('pmt_name', 'tools')->where('csu_id',$id)->latest('created_at')->value('status'),

            'amt_salary'=> CsuPaymentDetailModel::where('pmt_name', 'amt_salary')->where('csu_id',$id)->sum('amount'),
            'amt_salary_status' =>CsuPaymentDetailModel::where('pmt_name', 'amt_salary')->where('csu_id',$id)->latest('created_at')->value('status'),
            'total'=>CsuPaymentDetailModel::where('status','!=', 'not work done and  not payed')->where('csu_id',$id)->where('status','!=', 'work done but not payed')->sum('amount'),
            'pending_payment'=>CsuPaymentDetailModel::where('status',  'not work done and  not payed')->where('csu_id',$id)->sum('amount'),
            'outstanding_balance'=>CsuPaymentDetailModel::where('status', 'work done but not payed')->where('csu_id',$id)->sum('amount'),

    ]);
    }
}
