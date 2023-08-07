<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\EstimationWork;
use App\Models\SiteDataCollection;
use App\Models\SiteImage;
use Exception;
use Illuminate\Http\Request;
use App\Repositories\SiteVisitRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class siteDateCollection extends Controller
{
    private $siteRepository;

    public function __construct(SiteVisitRepository $siteRepository)
    {
        $this->siteRepository = $siteRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas = SiteDataCollection::withCount([
            'siteImg as count_before' => function ($query) {
                $query->where('status', 'before');
            },
            'siteImg as count_after' => function ($query) {
                $query->where('status', 'after');
            },
            'siteImg as count_during' => function ($query) {
                $query->where('status', 'during');
            },
        ])->get();

        // return $siteDataCollections;
        // $datas = SiteDataCollection::all();

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
        try {
            $data = SiteDataCollection::create($request->all());

            if ($request->image) {
                $this->siteRepository->addImages($request->image, $data->id, 'before');
            }
            DB::statement("UPDATE site_data_collections set geom = ST_GeomFromText('POINT($request->log $request->lat)',4326) where id = $data->id");
            return redirect()
                ->route('site-data-collection.index')
                ->with('success', 'Form Submitted');
        } catch (Exception $e) {
            return $e->getMessage();
            return redirect()
                ->route('site-data-collection.index')
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
        $data = SiteDataCollection::with('estWork')
            ->with('siteImg')
            ->find($id);
        // return $data;
        return $data ? view('siteDataCollections.show', ['data' => $data]) : abort(404);
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
        return view('siteDataCollections.edit', ['data' => $data]);
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
            SiteDataCollection::find($id)->update($request->all());
            return redirect()
                ->route('site-data-collection.index')
                ->with('success', 'Form Updated');
        } catch (Exception $e) {
            return redirect()
                ->route('site-data-collection.index')
                ->with('failed', 'Request failed');
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
            SiteDataCollection::find($id)->delete();

            EstimationWork::where('site_data_id', $id)->delete();
            $img = SiteImage::where('site_data_id', $id)->delete();
            // if($img){
            //     $this->siteRepository->removeImg($img);
            // }
            return redirect()
                ->route('site-data-collection.index')
                ->with('success', 'Record Removed');
        } catch (Exception $e) {
            return redirect()
                ->route('site-data-collection.index')
                ->with('failed', 'Request failed');
        }
    }
}
