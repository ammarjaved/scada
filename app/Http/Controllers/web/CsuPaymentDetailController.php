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
                $total = $data->total + $request->amount;
                $name  = $request->pmt_name;
                $nameTotal = $data->$name + $request->amount;
                $nameTotal = $data->$name + $request->amount;
                $mystatus=$name.'_status';
                $data->update(['total'=>$total, $name => $nameTotal,$mystatus=>$request->status]);
            CsuPaymentDetailModel::create([
                'pmt_name'      => $request->pmt_name,
                'amount'        => $request->amount,
                'status'        => $request->status,
                'description'   => $request->description,
                'csu_id'        => $request->id,
            ]);
         }
            return response()->json(['success'=>true, 'id'=>$data->id_csu_budget], 200);

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

        $res_data = [];
        try{
            $vcb_spend_data =  CsuPaymentDetailModel::find($id);

            if ($vcb_spend_data) {

                $data = CsuAeroSpendModel::find($vcb_spend_data->csu_id);

                $oldVal = $vcb_spend_data->amount;

                $total = $data->total + $request->amount - $oldVal;
                $name  = $vcb_spend_data->pmt_name;
                $nameTotal = $data->$name + $request->amount  - $vcb_spend_data->amount;
                $mystatus=$name.'_status';
                
                 $data->update(['total'=>$total, $name => $nameTotal, $mystatus=>$request->status]);
 
                $vcb_spend_data->update([
                'amount'        => $request->amount,
                'status'        => $request->status,
                'description'   => $request->description,
            ]);
            }else{
                return response()->json(['success'=>false, 'message'=>"something is wrong"], 200);
            }
            $res_data['sub_total'] = $total;
            $res_data['total'] = $nameTotal;
            $res_data['name'] = $request->inp_name;


            return response()->json(['success'=>true, 'id'=>$data->id_csu_budget , 'data'=>$res_data], 200);
    } catch (\Throwable $th) {
        return response()->json(['success'=>false, 'error'=>$th->getMessage()], 200);
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

            $total = $dataVcb->total - $data->amount ;
            $name  = $data->pmt_name;
            $nameTotal = $dataVcb->$name - $data->amount;
            $dataVcb->update(['total'=>$total, $name => $nameTotal]);
            $data->delete();

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
