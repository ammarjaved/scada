@extends('layouts.app')

@section('content')
    <section class="content-header">

        <div class="row mb-2" style="flex-wrap:nowrap">
            <div class="col-sm-6">
                <h3>RMU Budget TNB</h3>
            </div>
            <div class="col-sm-6 text-right">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{ route('site-data-collection.index' ) }}">site data</a></li>

                    <li class="breadcrumb-item"><a href="{{ route('rmu-budget-tnb.index' , $data->pe_name) }}">index</a></li>
                    <li class="breadcrumb-item active">show</li>
                </ol>
            </div>
        </div>

    </section>
    <section class="content">
        <div class="container-fluid">
    <div class="container bg-white  shadow my-4 " style="border-radius: 10px">


            <div class="row">
                <div class="col-md-4">
                    <label for="pe_name">Pe Name</label>
                </div>
                <div class="col-md-4">
                   <input disabled  value="{{$data->pe_name}}"   class="form-control" required >
                </div>
            </div>

            <!-- <div class="row">
                <div class="col-md-4">
                    <label for="vendor_name">Vendor Name</label>
                </div>
                <div class="col-md-4">
                   <input type="text" name="vendor_name" value="{{$data->vendor_name}}" id="vendor_name"  class="form-control" required disabled >
                </div>
            </div> -->
            <div class="row">
                <div class="col-md-4">
                    <label for="rtu_status">RTU Status</label>
                </div>
                <div class="col-md-4">
                   <input disabled value="{{$data->rtu_status}}"   class="form-control" required >
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-md-4">
                    <label for="pe name">Allocated Budget</label>
                </div>
                <div class="col-md-4">
                    <input type="number" value="{{$data->allocated_budget}}" disabled
                        class="form-control" required>
                </div>
            </div> --}}
            <div class="row">
                <div class="col-md-4">
                    <label for="amt_kkb_pk">AMT KKB PK</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{$data->amt_kkb_pk}}"   class="form-control" required>
                </div>
            </div>



            <div class="row">
                <div class="col-md-4">
                    <label for="cfs">CFS</label>
                </div>
                <div class="col-md-4">
                   <input disabled value="{{$data->cfs}}"  class="form-control" required>
                </div>
            </div>



            <div class="row">
                <div class="col-md-4">
                    <label for="total">Total Budget by TNB</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{$data->scada}}"   class="form-control" required>
                </div>
            </div>

            {{-- <div class="row">
                <div class="col-md-4">
                    <label for="pe name">Total Budget by Aerosynergy</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{$data->total}}"   class="form-control">
                </div>
            </div> --}}

            <div class="row">
                <div class="col-md-4">
                    <label for="pe name">Fix Profit Aerosynergy</label>
                </div>
                <div class="col-md-4">
                    <input type="number" readonly disabled  value="{{$data->fix_profit}}"
                        class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="date_time">Date Time</label>
                </div>
                <div class="col-md-4">
                    <input type="datetime-local"readonly disabled class="form-control" value="{{$data->date_time}}">
                </div>
            </div>



    </div>
        </div></section>
@endsection
