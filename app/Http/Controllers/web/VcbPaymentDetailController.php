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

            $data =  VcbAeroSpendModel::find($request->id);
            if ($data) {
                if ($request->status != 'work done but not payed') {
                    $total = $data->total + $request->amount;
                    $pending = $data->pending_payment;
                } else {
                    $total = $data->total;
                    $pending = $data->pending_payment + $request->amount;
                }
                $name  = $request->pmt_name;
                $nameTotal = $data->$name + $request->amount;
                $mystatus=$name.'_status';
               // return  $mystatus;
                $data->update(['total'=>$total, $name => $nameTotal, $mystatus=>$request->status , 'pending_payment' => $pending]);

            VcbPaymentDetailModel::create([
                'pmt_name'      => $request->pmt_name,
                'amount'        => $request->amount,
                'status'        => $request->status,
                'description'   => $request->description,
                'vcb_id'        => $request->id,
                'pmt_date' => $request->pmt_date,
            ]);
         }
            return response()->json(['success'=>true, 'id'=>$data->id_vcb_budget], 200);

        } catch (\Throwable $th) {
            return response()->json(['success'=>false, 'error'=>$th->getMessage()], 500);
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
        try{
            $vcb_spend_data =  VcbPaymentDetailModel::find($id);

            if ($vcb_spend_data) {

                $data = VcbAeroSpendModel::find($vcb_spend_data->vcb_id);

                $oldVal = $vcb_spend_data->amount;

                $total = $data->total + $request->amount - $oldVal;
                $name  = $vcb_spend_data->pmt_name;
                $nameTotal = $data->$name + $request->amount  - $vcb_spend_data->amount;
                $mystatus=$name.'_status';
                if ($request->status != 'work done but not payed' && $vcb_spend_data->status != 'work done but not payed') {
                    $pending = $data->pending_payment;
                    $total = $data->total + $request->amount - $oldVal;
                } elseif ($request->status == 'work done but not payed' && $vcb_spend_data->status != 'work done but not payed') {
                    $total = $data->total - $oldVal;
                    $pending = $data->pending_payment + $request->amount;
                } elseif ($request->status != 'work done but not payed' && $vcb_spend_data->status == 'work done but not payed') {
                    $total = $data->total + $request->amount;
                    $pending = $data->pending_payment - $oldVal;
                } elseif ($request->status == 'work done but not payed' && $vcb_spend_data->status == 'work done but not payed') {
                    $total = $data->total  ;
                    $pending = $data->pending_payment - $oldVal + $request->amount;
                }

                 $data->update(['total'=>$total, $name => $nameTotal, $mystatus=>$request->status , 'pending_payment' => $pending]);

                $vcb_spend_data->update([
                'amount'        => $request->amount,
                'status'        => $request->status,
                'description'   => $request->description,
                'pmt_date' => $request->pmt_date,
            ]);


            }else{
                return response()->json(['success'=>false, 'message'=>"something is wrong"], 500);
            }
            $res_data['sub_total'] = $total;
            $res_data['total'] = $nameTotal;
            $res_data['name'] = $request->inp_name;
            $res_data['pending_payment'] = $data->pending_payment;



            return response()->json(['success'=>true, 'id'=>$data->id_vcb_budget , 'data'=>$res_data], 200);
    } catch (\Throwable $th) {
        return response()->json(['success'=>false, 'error'=>$th->getMessage()], 500);
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
        $res_data = [];
        try{
          $data =  VcbPaymentDetailModel::find($id);
          if ($data) {

            $dataVcb = VcbAeroSpendModel::find($data->vcb_id);
            $created_at = $data->created_at ;

            if ($data->status != 'work done but not payed') {
                $total = $dataVcb->total - $data->amount;
                $pending = $dataVcb->pending_payment;
            } else {
                $total = $dataVcb->total;
                $pending = $dataVcb->pending_payment - $data->amount;
            }
            $name  = $data->pmt_name;
            $nameTotal = $dataVcb->$name - $data->amount;
            $stat = '';
            $latestRecord = VcbPaymentDetailModel::where('vcb_id' ,$dataVcb->id)->latest('created_at')->first();

            $data->delete();



            if ($latestRecord && $created_at == $latestRecord->created_at) {
                // return "inside if";
                $status = VcbPaymentDetailModel::where('vcb_id' ,$dataVcb->id)->latest()->first();
                if ($status) {

                    $stat = $status->status;
                }
            }else{
                $stat_name = $name.'_status';
                $stat = $dataVcb->$stat_name ;
                // return $stat;
            }
            // return $nameTotal;
            $dataVcb->update([
                'total' => $total,
                $name => $nameTotal,
                'pending_payment' => $pending,
                $name.'_status' => $stat,
            ]);




        }else{
            // return response()->json(['success'=>false, 'message'=>"something is wrong"], 200);
        }
        return redirect()->back();
    } catch (\Throwable $th) {
        return $th->getMessage();
        return  redirect()->back();
    }
    }
}
