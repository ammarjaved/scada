<?php

namespace App\Http\Controllers;

use App\Http\Controllers\web\siteDateCollection;
use App\Models\SiteDataCollection;
use Exception;
use Illuminate\Http\Request;

class updateSiteDataImages extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $data = SiteDataCollection::find($id);
        return view('siteDataCollections.uploadImages.edit', ['data' => $data]);
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
        $id = SiteDataCollection::find($id);
        $destinationPath = 'assets/images/';
        try {
            if ($request->has('image')) {
                foreach ($request->image as $key => $file) {
                    if ($request->hasFile('image.' . $key)) {
                        $file = $request->file('image.' . $key);
                        $img_exc = $file->getClientOriginalExtension();
                        $filename = $key . '-' . strtotime(now()) . '.' . $img_exc;
                        $file->move($destinationPath, $filename);
                        $request[$key] = $destinationPath . $filename;
                    }
                }
            }
            $id->update($request->all());
            return redirect()
                ->route('site-data-collection.index')
                ->with('success', 'Inserted Foam successfully');
        } catch (Exception $e) {
            return redirect()
                ->route('site-data-collection.index')
                ->with('failed', 'Inserted Foam failed');
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
    }
}
