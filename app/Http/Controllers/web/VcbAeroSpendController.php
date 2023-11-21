<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VcbAeroSpendModel;
use Exception;



class VcbAeroSpendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data = VcbAeroSpendModel::where('id_vcb_budget', $id)
            ->with('VcbBudget')
            ->first();
            try {
                $profit = (($data->VcbBudget->total - $data->total) / $data->VcbBudget->fix_profit) * 100;


            $data['profit'] = number_format($profit , 2);
            } catch (\Throwable $th) {
                $data['profit'] = "#error!";
            }

        // return $id;
        return view('vcb-aero-spend.index', ['data' => $data])->render();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function create($id, $pe_name)
    {
        //
        return view('vcb-aero-spend.create', ['id_tnb' => $id, 'pe_name' => $pe_name]);
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

        VcbAeroSpendModel::create($request->all());
        return redirect()->route('vcb-budget-tnb.index')->with('success',"Form Submitted");
    } catch (\Throwable $th) {
        return redirect()->route('vcb-budget-tnb.index')->with('failed',"Request Failed");

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
        $data = VcbAeroSpendModel::where('id', $id)
            ->with(['VcbBudget', 'SpendDetail'])
            ->first();
        $count = [];
        $count['amt_bo'] = [];
        $count['amt_piw'] = [];
        $count['amt_cable'] = [];
        $count['amt_transducer'] = [];
        $count['amt_rtu'] = [];
        $count['amt_rtu_cable'] = [];
        $count['tools'] = [];
        $count['amt_store_rental'] = [];
        $count['amt_transport'] = [];

        try {
            $profit = (($data->VcbBudget->total - $data->total) / $data->VcbBudget->fix_profit) * 100;



        $data['profit'] = number_format($profit , 2);
        } catch (\Throwable $th) {
            $datas['profit'] = "#error!";
        }

        foreach ($data->SpendDetail as $key => $value) {
            array_push($count[$value->pmt_name], $value);

        }
        return $data ? view('vcb-aero-spend.show',['data'=>$data,'count'=>$count]) : abrot(404);
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

        $data = VcbAeroSpendModel::where('id', $id)
            ->with(['VcbBudget', 'SpendDetail'])
            ->first();
        $count = [];

        $count['amt_bo'] = [];
        $count['amt_piw'] = [];
        $count['amt_cable'] = [];
        $count['amt_transducer'] = [];
        $count['amt_rtu'] = [];
        $count['amt_rtu_cable'] = [];
        $count['tools'] = [];
        $count['amt_store_rental'] = [];
        $count['amt_transport'] = [];

        try {
         $profit = (($data->VcbBudget->total - $data->total) / $data->VcbBudget->fix_profit) * 100;


        $data['profit'] = number_format($profit , 2);
        } catch (\Throwable $th) {
            $datas['profit'] = "#error!";
        }

        foreach ($data->SpendDetail as $key => $value) {
            array_push($count[$value->pmt_name], $value);

        }
        return $data ? view('vcb-aero-spend.edit',['data'=>$data,'count'=>$count]) : abrot(404);
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

        $data = VcbAeroSpendModel::find($id)->update($request->all());
        return redirect()->route('vcb-budget-tnb.index')->with('success',"Form update");
    } catch (\Throwable $th) {
        return redirect()->route('vcb-budget-tnb.index')->with('failed',"Request Failed");

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
            VcbAeroSpendModel::find($id)->delete();

            return redirect()
                ->route('vcb-budget-tnb.index')
                ->with('success', 'Record Removed');
        } catch (Exception $e) {
            return redirect()
                ->route('vcb-budget-tnb.index')
                ->with('failed', 'Request failed');
        }
    }
}
