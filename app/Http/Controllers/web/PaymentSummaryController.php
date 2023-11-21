<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentSummaryModel;
use App\Models\CsuBudgetTNBModel;


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
        // $total = 0 ;
        // $csu_budget =  \App\Models\CsuBudgetTNBModel::sum('total');
        // $rmu_budget =  \App\Models\RmuBudgetTNBModel::sum('total');
        // $vcb_budget =  \App\Models\VcbBudgetTNBModel::sum('total');
        // $total_budget = $csu_budget + $rmu_budget + $vcb_budget ;

        // $csu_spend = \App\Models\CsuAeroSpendModel::sum('total');
        // $rmu_spend = \App\Models\RmuAeroSpendModel::sum('total');
        // $vcb_spend = \App\Models\VcbAeroSpendModel::sum('total');
        // $total_spend = $csu_spend + $vcb_spend + $rmu_spend;

        // $csu_profit = \App\Models\CsuBudgetTNBModel::sum('fix_profit');
        // $rmu_profit = \App\Models\RmuBudgetTNBModel::sum('fix_profit');
        // $vcb_profit = \App\Models\VcbBudgetTNBModel::sum('fix_profit');
        // $total_profit = $csu_profit + $vcb_profit + $vcb_profit;

        //   $total_profit;

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
        try {

            PaymentSummaryModel::find($id)->update($request->all());
            return response()->json(['success'=>true, 'id'=>$id], 200);

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
        try {

            PaymentSummaryModel::find($id)->delete();
            return redirect()->route('payment-summary-details.index')->with('success',"Recored Removed");
        } catch (\Throwable $th) {
            return $th->getMessage();
            return redirect()->route('payment-summary-details.index')->with('failed',"Request Failed");
        }
    }
}
