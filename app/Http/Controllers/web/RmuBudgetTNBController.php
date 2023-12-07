<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RmuBudgetTNBModel;
use Exception;
use App\Models\RmuAeroSpendModel;
use App\Models\RmuPaymentDetailModel;
use Illuminate\Support\Facades\Session;

class RmuBudgetTNBController extends Controller
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

            $data = RmuBudgetTNBModel::where('pe_name', $name)
                ->withCount('RmuSpends')
                ->with(['RmuSpends'])
                ->first();
            if ($data) {
                return view('rmu-budget-tnb.index', ['data' => $data]);
            }
            return redirect()->route('rmu-budget-tnb.create', ['name' => $name]);
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
        return view('rmu-budget-tnb.form', ['name' => $name]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if ($request->id == '' && !RmuBudgetTNBModel::where('pe_name', $request->pe_name)->first()) {
                $storeBudget = RmuBudgetTNBModel::create($request->all());

                if ($storeBudget) {
                    RmuAeroSpendModel::create(['id_rmu_budget' => $storeBudget->id]);
                }
            } else {
                $rec = RmuBudgetTNBModel::find($request->id);
                if ($rec) {
                    $rec->update($request->all());
                }
                Session::flash('failed', 'Request Failed');
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            Session::flash('failed', 'Request Failed');
            return redirect()->back();
        }

        Session::flash('success', 'Request Success');
        return redirect()->route('rmu-budget-tnb.index', $request->pe_name);
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
        $data = RmuBudgetTNBModel::find($id);
        return $data ? view('rmu-budget-tnb.form', ['item' => $data, 'disabled' => true]) : abrot(404);
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
        $data = RmuBudgetTNBModel::find($id);
        return $data ? view('rmu-budget-tnb.form', ['item' => $data]) : abrot(404);
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
            RmuBudgetTNBModel::find($id)->delete();
            $data = RmuAeroSpendModel::where('id_rmu_budget', $id);
            $getData = $data->first();

            if ($getData) {
                $paymentData = RmuPaymentDetailModel::where('rmu_id', $getData->id);

                if ($paymentData->get()) {
                    $paymentData->delete();
                }
                $data->delete();
            }
        } catch (\Throwable $th) {
            Session::flash('failed', 'Request Failed');
            return redirect()->back();
        }

        Session::flash('success', 'Request Success');

        return redirect()->route('site-data-collection.index');
    }
}
