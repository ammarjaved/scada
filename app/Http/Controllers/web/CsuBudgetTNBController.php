<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CsuBudgetTNBModel;
use Exception;
use App\Models\CsuAeroSpendModel;
use App\Models\CsuPaymentDetailModel;





class CsuBudgetTNBController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($name)
    {
        //
        $data =  CsuBudgetTNBModel::where('pe_name', $name)->withCount('CsuSpends')->with(['CsuSpends'])->first();
        if ($data) {
            return view('csu-budget-tnb.index',['data'=> $data]) ;
        }
        return redirect()->route('csu-budget-tnb.create' ,['name'=>$name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($name)
    {
        //

        return view('csu-budget-tnb.create' ,['name'=>$name]);
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
            //code...

        $storeBudget = CsuBudgetTNBModel::create($request->all());

        if ($storeBudget) {
            CsuAeroSpendModel::create(['id_csu_budget'=>$storeBudget->id]);
        }
        return redirect()->route('csu-budget-tnb.index', $request->pe_name)->with('success',"Form Submitted");
    } catch (\Throwable $th) {
        return $th->getMessage();
        return redirect()->route('csu-budget-tnb.index' , $request->pe_name)->with('failed',"Request Failed");

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

        $data = CsuBudgetTNBModel::find($id);
        return $data ? view('csu-budget-tnb.show',['data'=>$data]) : abrot(404);
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
        $data = CsuBudgetTNBModel::find($id);
        return $data ? view('csu-budget-tnb.edit',['data'=>$data]) : abrot(404);
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
            //code...

        $data = CsuBudgetTNBModel::find($id)->update($request->all());
        return redirect()->route('csu-budget-tnb.index',$request->pe_name)->with('success',"Form update");
    } catch (\Throwable $th) {
        return redirect()->route('csu-budget-tnb.index',$request->pe_name)->with('failed',"Request Failed");

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
            CsuBudgetTNBModel::find($id)->delete();
            $data = CsuAeroSpendModel::where('id_csu_budget',$id);
            $getData = $data->first();
            if ($getData) {
                $paymentData = CsuPaymentDetailModel::where('csu_id' , $getData->id);
                if ($paymentData->get()) {
                    $paymentData->delete();
                }
                $data->delete();

            }

            return redirect()
                ->route('site-data-collection.index')
                ->with('success', 'Record Removed');
        } catch (Exception $e) {
            return redirect()
                ->route('site-data-collection.index')
                ->with('failed', 'Request failed');
        }
    }
}
