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
        $datas = VcbAeroSpendModel::where('id_vcb_budget', $id)
            ->with('VcbBudget')
            ->get();
        // return $id;
        return view('vcb-aero-spend.index', ['datas' => $datas])->render();

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
        $data = VcbAeroSpendModel::where('id',$id)->with('VcbBudget')->first();
        return $data ? view('vcb-aero-spend.show',['data'=>$data]) : abrot(404);
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
        $data = VcbAeroSpendModel::where('id',$id)->with('VcbBudget')->first();
        return $data ? view('vcb-aero-spend.edit',['data'=>$data]) : abrot(404);
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
