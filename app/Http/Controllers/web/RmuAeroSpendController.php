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
    public function index()
    {
        //
        return view('rmu-aero-spend.index',['datas'=>RmuAeroSpendModel::all()]) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id,$pe_name)
    {
        //
        return view('rmu-aero-spend.create',['id_tnb'=>$id,'pe_name'=>$pe_name]);
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
        return redirect()->route('rmu-budget-tnb.index')->with('success',"Form Submitted");
    } catch (\Throwable $th) {
        return $th->getMessage();
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
        $data = RmuAeroSpendModel::find($id);
        return $data ? view('rmu-aero-spend.show',['data'=>$data]) : abrot(404);
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
        $data = RmuAeroSpendModel::find($id);
        return $data ? view('rmu-aero-spend.edit',['data'=>$data]) : abrot(404);
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
        return redirect()->route('rmu-aero-spend.index')->with('success',"Form update");
    } catch (\Throwable $th) {
        return redirect()->route('rmu-aero-spend.index')->with('failed',"Request Failed");

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
                ->route('rmu-aero-spend.index')
                ->with('success', 'Record Removed');
        } catch (Exception $e) {
            return redirect()
                ->route('rmu-aero-spend.index')
                ->with('failed', 'Request failed');
        }
    }
}
