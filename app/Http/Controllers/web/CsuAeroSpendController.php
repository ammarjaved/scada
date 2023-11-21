<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CsuAeroSpendModel;
use Exception;

class CsuAeroSpendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $data = CsuAeroSpendModel::where('id_csu_budget', $id)
            ->with('CsuBudget')
            ->first();
        try {
            $profit = ($data->CsuBudget->total / $data->total) * 100;
            $data['profit'] = number_format($profit, 2);
        } catch (\Throwable $th) {
            $data['profit'] = '#error!';
        }
        return view('csu-aero-spend.index', ['data' => $data])->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id, $pe_name)
    {
        //
        return view('csu-aero-spend.create', ['id_tnb' => $id, 'pe_name' => $pe_name]);
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

            CsuAeroSpendModel::create($request->all());
            return redirect()
                ->route('csu-budget-tnb.index')
                ->with('success', 'Form Submitted');
        } catch (\Throwable $th) {
            return redirect()
                ->route('csu-budget-tnb.index')
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

        $data = CsuAeroSpendModel::where('id', $id)
            ->with(['CsuBudget', 'SpendDetail'])
            ->first();
        $count = [];
        $count['amt_kkb'] = [];
        $count['amt_cfs'] = [];
        $count['amt_bo'] = [];
        $count['amt_rtu'] = [];
        $count['tools'] = [];
        $count['amt_store_rental'] = [];
        $count['amt_transport'] = [];
        $count['amt_salary'] = [];
        try {
            $profit = (($data->CsuBudget->allocated_budget - $data->total) / $data->CsuBudget->allocated_budget) * 100;
            $data['profit'] = number_format($profit, 2);
        } catch (\Throwable $th) {
            $data['profit'] = '#error!';
        }
        foreach ($data->SpendDetail as $key => $value) {
            array_push($count[$value->pmt_name], $value);
        }

        return $data ? view('csu-aero-spend.show', ['data' => $data, 'count' => $count]) : abrot(404);
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
        $data = CsuAeroSpendModel::where('id', $id)
            ->with(['CsuBudget', 'SpendDetail'])
            ->first();
        $count = [];
        $count['amt_kkb'] = [];
        $count['amt_cfs'] = [];
        $count['amt_bo'] = [];
        $count['amt_rtu'] = [];
        $count['tools'] = [];
        $count['amt_store_rental'] = [];
        $count['amt_transport'] = [];
        $count['amt_salary'] = [];
        try {
            $profit = (($data->CsuBudget->allocated_budget - $data->total) / $data->CsuBudget->allocated_budget) * 100;
            $data['profit'] = number_format($profit, 2);
        } catch (\Throwable $th) {
            $data['profit'] = '#error!';
        }
        foreach ($data->SpendDetail as $key => $value) {
            array_push($count[$value->pmt_name], $value);
        }

        return $data ? view('csu-aero-spend.edit', ['data' => $data, 'count' => $count]) : abrot(404);
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
        try {
            //code...

            $data = CsuAeroSpendModel::find($id)->update($request->all());
            return redirect()
                ->route('csu-budget-tnb.index')
                ->with('success', 'Form update');
        } catch (\Throwable $th) {
            return redirect()
                ->route('csu-budget-tnb.index')
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
            CsuAeroSpendModel::find($id)->delete();

            return redirect()
                ->route('csu-budget-tnb.index')
                ->with('success', 'Record Removed');
        } catch (Exception $e) {
            return redirect()
                ->route('csu-budget-tnb.index')
                ->with('failed', 'Request failed');
        }
    }
}
