<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VcbBudgetTNBModel;
use Exception;
use App\Models\VcbAeroSpendModel;
use App\Models\VcbPaymentDetailModel;

class VcbBudgetTNBController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($name)
    {
        try {
            //code...

            $data = VcbBudgetTNBModel::where('pe_name', $name)
                ->withCount('VcbSpends')
                ->with(['VcbSpends'])
                ->first();
            if ($data) {
                return view('vcb-budget-tnb.index', ['data' => $data]);
            }
            return redirect()->route('vcb-budget-tnb.create', ['name' => $name]);
        } catch (\Throwable $th) {
            return redirect()->back();
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($name)
    {
        //
        return view('vcb-budget-tnb.create',['name'=>$name]);
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
            $storeBudget = VcbBudgetTNBModel::create($request->all());

            if ($storeBudget) {
                VcbAeroSpendModel::create(['id_vcb_budget' => $storeBudget->id]);
            }

            return redirect()
                ->route('vcb-budget-tnb.index',$request->pe_name)
                ->with('success', 'Form Submitted');
        } catch (\Throwable $th) {
            return $th->getMessage();
            return redirect()
                ->route('vcb-budget-tnb.index' , $request->pe_name)
                ->with('failed', 'Request Failed');
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
        $data = VcbBudgetTNBModel::find($id);
        return $data ? view('vcb-budget-tnb.show', ['data' => $data]) : abrot(404);
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
        $data = VcbBudgetTNBModel::find($id);
        return $data ? view('vcb-budget-tnb.edit', ['data' => $data]) : abrot(404);
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

            $data = VcbBudgetTNBModel::find($id)->update($request->all());
            return redirect()
                ->route('vcb-budget-tnb.index',$request->pe_name)
                ->with('success', 'Form update');
        } catch (\Throwable $th) {
            return redirect()
                ->route('vcb-budget-tnb.index',$request->pe_name)
                ->with('failed', 'Request Failed');
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
            VcbBudgetTNBModel::find($id)->delete();
            $data = VcbAeroSpendModel::where('id_vcb_budget', $id);
            $getData = $data->first();
            if ($getData) {
                $paymentData = VcbPaymentDetailModel::where('vcb_id', $getData->id);
                if ($paymentData->get()) {
                    $paymentData->delete();
                }

                $data->delete();
            }

            return redirect()
                ->route('site-data-collection.index')
                ->with('success', 'Record Removed');
        } catch (Exception $e) {
            return $e->getMessage();
            return redirect()
                ->route('site-data-collection.index')
                ->with('failed', 'Request failed');
        }
    }
}
