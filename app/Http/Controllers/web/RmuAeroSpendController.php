<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RmuAeroSpendModel;
use Exception;

class RmuAeroSpendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $data = RmuAeroSpendModel::where('id_rmu_budget', $id)
            ->with('RmuBudget')
            ->first();
        // return $datas;
        return view('rmu-aero-spend.index', ['data' => $data])->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id, $pe_name)
    {
        //
        return view('rmu-aero-spend.create', ['id_tnb' => $id, 'pe_name' => $pe_name]);
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

            RmuAeroSpendModel::create($request->all());
            return redirect()
                ->route('rmu-budget-tnb.index')
                ->with('success', 'Form Submitted');
        } catch (\Throwable $th) {
            // return $th->getMessage();
            return redirect()
                ->route('rmu-budget-tnb.index')
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
        // return $data = RmuAeroSpendModel::where('id',$id)
        //                 ->with([
        //                     'RmuBudget',
        //                     'RmuSpendDetail as abc' => function ($query) {
        //                         $query->where('pmt_name', 'amt_kkb');
        //                     },
        //                     'RmuSpendDetail as bbc' => function ($query) {
        //                         $query->where('pmt_name', 'amt_ir');
        //                     },
        //                 ])->first();
            $data = RmuAeroSpendModel::where('id',$id)
                    ->with([
                            'RmuBudget',
                            'RmuSpendDetail'])->first();
            $count = [];
            $count['amt_kkb'] = [];
            $count['amt_kkb_count'] = 1;
            $count['amt_ir'] =[];
            $count['amt_ir_count'] = 1;
            $count['amt_bo'] =[];
            $count['amt_bo_count'] =1;
            $count['amt_piw'] =[];
            $count['amt_piw_count'] =1;
            $count['amt_cable'] =[];
            $count['amt_cable_count'] =1;
            $count['amt_rtu'] =[];
            $count['amt_rtu_count'] =1;
            $count['amt_rtu_cable'] =[];
            $count['amt_rtu_cable_count'] =1;
            $count['tools'] =[];
            $count['tools_count'] =1;
            $count['amt_store_rental'] =[];
            $count['amt_store_rental_count'] =1;
            $count['amt_transport'] =[];
            $count['amt_transport_count'] =1;
                        

            foreach ($data->RmuSpendDetail as $key => $value) {
                array_push($count[$value->pmt_name],$value);
                $count[$value->pmt_name."_count"] +=1;
            }


        return $data ? view('rmu-aero-spend.show', ['data' => $data ,'count'=>$count]) : abrot(404);
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
        $data = RmuAeroSpendModel::where('id',$id)->with('RmuBudget')->first();
        return $data ? view('rmu-aero-spend.edit', ['data' => $data]) : abrot(404);
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

            $data = RmuAeroSpendModel::find($id)->update($request->all());
            return redirect()
                ->route('rmu-budget-tnb.index')
                ->with('success', 'Form update');
        } catch (\Throwable $th) {
            return redirect()
                ->route('rmu-budget-tnb.index')
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
            RmuAeroSpendModel::find($id)->delete();

            return redirect()
                ->route('rmu-budget-tnb.index')
                ->with('success', 'Record Removed');
        } catch (Exception $e) {
            return redirect()
                ->route('rmu-budget-tnb.index')
                ->with('failed', 'Request failed');
        }
    }
}
