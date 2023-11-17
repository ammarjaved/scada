@extends('layouts.app')

@section('content')
    <section class="content-header">

        <div class="row mb-2" style="flex-wrap:nowrap">
            <div class="col-sm-6">
                <h3>VCB AERO Spend</h3>
            </div>
            <div class="col-sm-6 text-right">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{ route('vcb-budget-tnb.index') }}">index</a></li>
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
                <label for="amt_kkb">PE NAME</label>
            </div>
            <div class="col-md-4">
               <input value="{{$data->VcbBudget->pe_name}}"   class="form-control"   readonly>
            </div>
        </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="amt_bo">Cost BO</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{$data->amt_bo}}"   class="form-control" required>
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="amt_bo_status">Cost BO Status</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{$data->amt_bo_status}}" id="amt_bo_status" class="form-control" required>
                </div>
            </div>



            <div class="row">
                <div class="col-md-4">
                    <label for="amt_piw">Cost PIW</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{$data->amt_piw}}"  class="form-control" required>
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="amt_piw_status">Cost PIW Status</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{$data->amt_piw_status}}" class="form-control" required>
                </div>
            </div>





            <div class="row">
                <div class="col-md-4">
                    <label for="amt_cable">Cost Cable</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{$data->amt_cable}}" class="form-control">
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="amt_cable_status">Cost Cable Status</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{$data->amt_cable_status}}" class="form-control">
                </div>
            </div>



            <div class="row">
                <div class="col-md-4">
                    <label for="amt_transducer">Cost Transducer</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{$data->amt_transducer}}" class="form-control">
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="amt_transducer_status">Cost Transducer Status</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{$data->amt_transducer_status}}" class="form-control">
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="amt_rtu">Cost RTU</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{$data->amt_rtu}}" class="form-control">
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="amt_rtu_status">Cost RTU Status</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{$data->amt_rtu_status}}" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="amt_rtu_cable">Cost RTU Cable</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{$data->amt_rtu_cable}}" class="form-control">
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="amt_rtu_cable_status">Cost RTU Cable Status</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{$data->amt_rtu_cable_status}}" class="form-control">
                </div>
            </div>



            <div class="row">
                <div class="col-md-4">
                    <label for="tools">Tools</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{$data->tools}}" class="form-control">

                </div>
            </div>




            <div class="row">
                <div class="col-md-4">
                    <label for="amt_tools_status">Cost Tools Status</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{$data->amt_tools_status}}"   class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="amt_store_rental">Cost Store Rental</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{$data->amt_store_rental}}"  class="form-control">
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="amt_store_rental_status">Cost Store Rental Status</label>

                </div>
                <div class="col-md-4">
                    <input disabled value="{{$data->amt_store_rental_status}}"  class="form-control">

                </div>
            </div>



            <div class="row">
                <div class="col-md-4">
                    <label for="amt_transport">Cost Transport</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{$data->amt_transport}}"    class="form-control">

                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="amt_transport_status">Cost Transport Status</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{$data->amt_transport_status}}"  class="form-control">

                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="total">Total</label>
                </div>
                <div class="col-md-4">
                    <input disabled value="{{$data->total}}" class="form-control">

                </div>
            </div>





    </div>
        </div></section>
@endsection

@section('script')
