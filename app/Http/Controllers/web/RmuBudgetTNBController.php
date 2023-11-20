<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RmuBudgetTNBModel;
use Exception;
use App\Models\RmuAeroSpendModel;
use App\Models\RmuPaymentDetailModel;

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
        return view('rmu-budget-tnb.create', ['name' => $name]);
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

            $storeBudget = RmuBudgetTNBModel::create($request->all());
            if ($storeBudget) {
                RmuAeroSpendModel::create(['id_rmu_budget' => $storeBudget->id]);
            }

            return redirect()
                ->route('rmu-budget-tnb.index', $request->pe_name)
                ->with('success', 'Form Submitted');
        } catch (\Throwable $th) {
            return $th->getMessage();
            return redirect()
                ->route('rmu-budget-tnb.index', $request->pe_name)
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
        $data = RmuBudgetTNBModel::find($id);
        return $data ? view('rmu-budget-tnb.show', ['data' => $data]) : abrot(404);
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
        return $data ? view('rmu-budget-tnb.edit', ['data' => $data]) : abrot(404);
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

            $data = RmuBudgetTNBModel::find($id)->update($request->all());
            return redirect()
                ->route('rmu-budget-tnb.index', $request->name)
                ->with('success', 'Form update');
        } catch (\Throwable $th) {
            return redirect()
                ->route('rmu-budget-tnb.index', $request->name)
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
