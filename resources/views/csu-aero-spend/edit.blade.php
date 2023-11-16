@extends('layouts.app')

@section('content')
    <section class="content-header">

        <div class="row mb-2" style="flex-wrap:nowrap">
            <div class="col-sm-6">
                <h3>CSU AERO Spend</h3>
            </div>
            <div class="col-sm-6 text-right">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{ route('csu-aero-spend.index') }}">index</a></li>
                    <li class="breadcrumb-item active">edit</li>
                </ol>
            </div>
        </div>

    </section>
    <section class="content">
        <div class="container-fluid">
    <div class="container bg-white  shadow my-4 " style="border-radius: 10px">


        <form action="{{ route('csu-aero-spend.update' , $data->id) }}" id="myForm" method="post">
            @csrf
            @method('PATCH')


            <div class="row">
                <div class="col-md-4">
                    <label for="amt_kkb">AMT KKB</label>
                </div>
                <div class="col-md-4">
                   <input value="{{$data->amt_kkb}}" type="number" name="amt_kkb" id="amt_kkb" class="form-control" required >
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="amt_kkb_status">AMT KKB Status</label>
                </div>
                <div class="col-md-4">
                    <input value="{{$data->amt_kkb_status}}" type="text" name="amt_kkb_status" id="amt_kkb_status" class="form-control" required>
                </div>
            </div>



            <div class="row">
                <div class="col-md-4">
                    <label for="amt_cfs">AMT CFS</label>
                </div>
                <div class="col-md-4">
                   <input value="{{$data->amt_cfs}}" type="number" name="amt_cfs" id="amt_cfs" class="form-control" required>
                </div>
            </div>



            <div class="row">
                <div class="col-md-4">
                    <label for="amt_cfs_status">AMT CFS Status</label>
                </div>
                <div class="col-md-4">
                    <input value="{{$data->amt_cfs_status}}" type="text" name="amt_cfs_status" id="amt_cfs_status" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="amt_bo">AMT BO</label>
                </div>
                <div class="col-md-4">
                    <input value="{{$data->amt_bo}}" type="number" name="amt_bo" id="amt_bo" class="form-control">
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="amt_bo_status">AMT BO Status</label>
                </div>
                <div class="col-md-4">
                    <input value="{{$data->amt_bo_status}}" type="text" name="amt_bo_status" id="amt_bo_status" class="form-control">
                </div>
            </div>




            <div class="row">
                <div class="col-md-4">
                    <label for="amt_rtu">AMT RTU</label>
                </div>
                <div class="col-md-4">
                    <input value="{{$data->amt_rtu}}" type="number" name="amt_rtu" id="amt_rtu" class="form-control">
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="amt_rtu_status">AMT RTU Status</label>
                </div>
                <div class="col-md-4">
                    <input value="{{$data->amt_rtu_status}}" type="text" name="amt_rtu_status" id="amt_rtu_status" class="form-control">
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="tools">Tools</label>
                </div>
                <div class="col-md-4">
                    <input value="{{$data->tools}}" name="tools" id="tools" type="number" class="form-control">

                </div>
            </div>




            <div class="row">
                <div class="col-md-4">
                    <label for="amt_tools_status">AMT Tools Status</label>
                </div>
                <div class="col-md-4">
                    <input value="{{$data->amt_tools_status}}" type="text" name="amt_tools_status" id="amt_tools_status" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="amt_store_rental">AMT Store Rental</label>
                </div>
                <div class="col-md-4">
                    <input value="{{$data->amt_store_rental}}" type="number" name="amt_store_rental" id="amt_store_rental" class="form-control">
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="amt_store_rental_status">AMT Store Rental Status</label>

                </div>
                <div class="col-md-4">
                    <input value="{{$data->amt_store_rental_status}}" type="text" name="amt_store_rental_status" id="amt_store_rental_status" class="form-control">

                </div>
            </div>



            <div class="row">
                <div class="col-md-4">
                    <label for="amt_transport">AMT Transport</label>
                </div>
                <div class="col-md-4">
                    <input value="{{$data->amt_transport}}" type="number" name="amt_transport" id="amt_transport"  class="form-control">

                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="amt_transport_status">AMT Transport Status</label>
                </div>
                <div class="col-md-4">
                    <input value="{{$data->amt_transport_status}}" type="text" name="amt_transport_status" id="amt_transport_status" class="form-control">

                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="amt_salary">AMT Salary</label>
                </div>
                <div class="col-md-4">
                    <input value="{{$data->amt_salary}}" type="number" name="amt_salary" id="amt_salary" class="form-control">

                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="amt_salary_status">AMT Salary Status</label>
                </div>
                <div class="col-md-4">
                    <input value="{{$data->amt_salary_status}}" type="text" name="amt_salary_status" id="amt_salary_status" class="form-control">

                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="total">Total</label>
                </div>
                <div class="col-md-4">
                    <input value="{{$data->total}}" type="number" name="total" id="total" class="form-control">

                </div>
            </div>



            <div class="text-center">
                <button class="btn btn-success mt-4" style="cursor: pointer !important" type="submit">Update</button>
            </div>

        </form>
    </div>
        </div></section>
@endsection

@section('script')

<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
    <script>
        $(document).ready(function() {

            $("#myForm").validate();


        })


    </script>
@endsection
