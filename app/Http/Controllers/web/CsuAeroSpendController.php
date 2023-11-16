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
    public function index()
    {
        //
        return view('csu-aero-spend.index',['datas'=>CsuAeroSpendModel::all()]) ;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('csu-aero-spend.create');
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
        return redirect()->route('csu-aero-spend.index')->with('success',"Form Submitted");
    } catch (\Throwable $th) {
        return redirect()->route('csu-aero-spend.index')->with('failed',"Request Failed");

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
        $data = CsuAeroSpendModel::find($id);
        return $data ? view('csu-aero-spend.show',['data'=>$data]) : abrot(404);
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
        $data = CsuAeroSpendModel::find($id);
        return $data ? view('csu-aero-spend.edit',['data'=>$data]) : abrot(404);
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
        return redirect()->route('csu-aero-spend.index')->with('success',"Form update");
    } catch (\Throwable $th) {
        return redirect()->route('csu-aero-spend.index')->with('failed',"Request Failed");

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
                ->route('csu-aero-spend.index')
                ->with('success', 'Record Removed');
        } catch (Exception $e) {
            return redirect()
                ->route('csu-aero-spend.index')
                ->with('failed', 'Request failed');
        }
    }
}
