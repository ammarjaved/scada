<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\SiteDataCollection;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class siteDateCollection extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas = SiteDataCollection::all();
        return view('siteDataCollections.index', ['datas' => $datas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('siteDataCollections.create');
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

        // $file = $request->file('img');
        // $file_name = time().'_'.$file->getClientOriginalName();
        // $img = \Image::make($file);
        // $img->save(\public_path('assets/images/'.$file_name),5);
        // return back();
       
          
        $destinationPath = 'assets/images/';

        try {
            if($request->has('image')){
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
            SiteDataCollection::create($request->all());
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = SiteDataCollection::find($id);
        return view('siteDataCollections.show',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = SiteDataCollection::find($id);
        return view('siteDataCollections.edit',['data'=>$data]);
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
        $destinationPath = 'assets/images/';
        try {
            if($request->has('image')){
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
            SiteDataCollection::find($id)->update($request->all());
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
        try{

        SiteDataCollection::find($id)->delete();
  
        return redirect()
                ->route('site-data-collection.index')
                ->with('success', 'Inserted Foam successfully');
        } catch (Exception $e) {
            return redirect()
                ->route('site-data-collection.index')
                ->with('failed', 'Inserted Foam failed');
        }
    }


}
