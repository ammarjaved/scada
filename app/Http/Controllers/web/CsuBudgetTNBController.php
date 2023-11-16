<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CsuBudgetTNBModel;
use Exception;
use App\Models\CsuAeroSpendModel;




class CsuBudgetTNBController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('csu-budget-tnb.index',['datas'=>
        CsuBudgetTNBModel::withCount('CsuSpends')->with(['CsuSpends'])->get()
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
        return view('csu-budget-tnb.create');
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

        CsuBudgetTNBModel::create($request->all());
        return redirect()->route('csu-budget-tnb.index')->with('success',"Form Submitted");
    } catch (\Throwable $th) {
        return redirect()->route('csu-budget-tnb.index')->with('failed',"Request Failed");

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
        return redirect()->route('csu-budget-tnb.index')->with('success',"Form update");
    } catch (\Throwable $th) {
        return redirect()->route('csu-budget-tnb.index')->with('failed',"Request Failed");

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
            if ($data->get()) {
                $data->delete();

            }

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
