<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RmuBudgetTNBModel;
use Exception;
use App\Models\RmuAeroSpendModel;




class RmuBudgetTNBController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('rmu-budget-tnb.index',['datas'=>
                RmuBudgetTNBModel::withCount('RmuSpends')->with(['RmuSpends'])->get()
            ]) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('rmu-budget-tnb.create');
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

        RmuBudgetTNBModel::create($request->all());
        return redirect()->route('rmu-budget-tnb.index')->with('success',"Form Submitted");
    } catch (\Throwable $th) {
        return redirect()->route('rmu-budget-tnb.index')->with('failed',"Request Failed");

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
        return $data ? view('rmu-budget-tnb.show',['data'=>$data]) : abrot(404);
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
        return $data ? view('rmu-budget-tnb.edit',['data'=>$data]) : abrot(404);
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
        return redirect()->route('rmu-budget-tnb.index')->with('success',"Form update");
    } catch (\Throwable $th) {
        return redirect()->route('rmu-budget-tnb.index')->with('failed',"Request Failed");

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
            $data = RmuAeroSpendModel::where('id_rmu_budget',$id);
            if ($data->get()) {
                $data->delete();

            }

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
