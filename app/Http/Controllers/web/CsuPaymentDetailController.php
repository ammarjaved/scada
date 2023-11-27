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

            $data =  CsuAeroSpendModel::find($request->id);
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

                $mystatus=  $name == 'tools' ? 'amt_'.$name.'_status' : $name.'_status';

                $data->update(['total'=>$total, $name => $nameTotal,$mystatus=>$request->status,  'pending_payment' => $pending]);
            CsuPaymentDetailModel::create([
                'pmt_name'      => $request->pmt_name,
                'amount'        => $request->amount,
                'status'        => $request->status,
                'description'   => $request->description,
                'csu_id'        => $request->id,
                'pmt_date'      => $request->pmt_date,
            ]);
         }
            return response()->json(['success'=>true, 'id'=>$data->id_csu_budget], 200);

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
        //

        $res_data = [];
        try{
            $vcb_spend_data =  CsuPaymentDetailModel::find($id);

            if ($vcb_spend_data) {

                $data = CsuAeroSpendModel::find($vcb_spend_data->csu_id);

                $oldVal = $vcb_spend_data->amount;


                $name  = $vcb_spend_data->pmt_name;
                $nameTotal = $data->$name + $request->amount  - $vcb_spend_data->amount;


                $mystatus=  $name == 'tools' ? 'amt_'.$name.'_status' : $name.'_status';

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

                 $latestRecord = CsuPaymentDetailModel::where('csu_id' ,$data->id)->where('pmt_name' , $vcb_spend_data-> pmt_name)->latest('created_at')->first();
                $status = $request->status;
                if ($latestRecord && $vcb_spend_data->created_at != $latestRecord->created_at) {

                        $status = $data->$mystatus;
                }
                


                 $data->update(['total'=>$total, $name => $nameTotal, $mystatus=>$status , 'pending_payment' => $pending]);

                $vcb_spend_data->update([
                'amount'        => $request->amount,
                'status'        => $request->status,
                'description'   => $request->description,
                'pmt_date'      => $request->pmt_date,
            ]);
            }else{
                return response()->json(['success'=>false, 'message'=>"something is wrong"], 200);
            }
            $res_data['sub_total'] = $total;
            $res_data['total'] = $nameTotal;
            $res_data['name'] = $request->inp_name;
            $res_data['pending_payment'] = $data->pending_payment;



            return response()->json(['success'=>true, 'id'=>$data->id_csu_budget , 'data'=>$res_data], 200);
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
          $data =  CsuPaymentDetailModel::find($id);
          if ($data) {


            $dataVcb = CsuAeroSpendModel::find($data->csu_id);

            $created_at = $data->created_at ;
            if ($data->status != 'work done but not payed') {
                $total = $dataVcb->total - $data->amount;
                $pending = $dataVcb->pending_payment;
            } else {
                $total = $dataVcb->total;
                $pending = $dataVcb->pending_payment - $data->amount;
            }
            $name  = $data->pmt_name;
            $stat_name=  $name == 'tools' ? 'amt_'.$name.'_status' : $name.'_status';
            $nameTotal = $dataVcb->$name - $data->amount;

            $stat = '';
            $latestRecord = CsuPaymentDetailModel::where('csu_id' ,$dataVcb->id)->where('pmt_name' , $data-> pmt_name)->latest('created_at')->first();
            $data->delete();

                $stat = '';
               if ($latestRecord && $created_at == $latestRecord->created_at) {

                $status = CsuPaymentDetailModel::where('csu_id' ,$dataVcb->id)->where('pmt_name' , $data-> pmt_name)->latest()->first();
                if ($status) {
                    $stat = $status->status;
                }
                }else{
                    $stat = $dataVcb->$stat_name ;

                }


            $dataVcb->update([
                'total' => $total,
                $name => $nameTotal,
                'pending_payment' => $pending,
                $stat_name => $stat,
            ]);
        }else{
            return  redirect()->back()->with('failed','Request Success');
        }
        return redirect()->back()->with('success','Request Success');
    } catch (\Throwable $th) {
        // return $th->getMessage();
        return  redirect()->back()->with('failed','Request Success');
    }
    }
}
