@extends('layouts.app')

@section('content')
    <section class="content-header">

        <div class="row mb-2" style="flex-wrap:nowrap">
            <div class="col-sm-6">
                <h3>CSU Budget TNB</h3>
            </div>
            <div class="col-sm-6 text-right">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{ route('csu-budget-tnb.index') }}">index</a></li>
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
                   <input disabled value="{{$data->pe_name}}"   class="form-control" required >
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="kkb">KKB</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{$data->kkb}}"   class="form-control" required>
                </div>
            </div>



            <div class="row">
                <div class="col-md-4">
                    <label for="cfs">CFS</label>
                </div>
                <div class="col-md-4">
                   <input disabled value="{{$data->cfs}}" class="form-control" required>
                </div>
            </div>



            <div class="row">
                <div class="col-md-4">
                    <label for="scada">Scada</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{$data->scada}}"   class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="total">Total</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{$data->total}}"  class="form-control">
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="date_time">Date Time</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{$data->date_time}}"   class="form-control">
                </div>
            </div>







    </div>
        </div></section>
@endsection

