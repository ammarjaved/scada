@extends('layouts.app')

@section('content')
    <section class="content-header">

        <div class="row mb-2" style="flex-wrap:nowrap">
            <div class="col-sm-6">
                <h3>CSU AERO Spend</h3>
            </div>
            <div class="col-sm-6 text-right">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{ route('csu-budget-tnb.index') }}">index</a></li>
                    <li class="breadcrumb-item active">create</li>
                </ol>
            </div>
        </div>

    </section>
    <section class="content">
        <div class="container-fluid">
    <div class="container bg-white  shadow my-4 " style="border-radius: 10px">


        <form action="{{ route('csu-aero-spend.store') }}" id="myForm" method="post">
            @csrf

            <div class="row">
                <div class="col-md-4">
                    <label for="pe name">PE NAME</label>
                </div>
                <div class="col-md-4">
                   <input type="text" name="pe_name" id="pe_name" value="{{$pe_name}}" class="form-control" required readonly >
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="amt_kkb">Cost KKB</label>
                </div>
                <div class="col-md-4">
                   <input type="number" name="amt_kkb" id="amt_kkb" class="form-control" required >
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="amt_kkb_status">Cost KKB Status</label>
                </div>
                <div class="col-md-4">
                    <select name="amt_kkb_status" id="amt_kkb_status" class="form-control">
                        <option value="" hidden>select status</option>
                        <option value="work done and payed">work done and payed</option>
                        <option value="work done but not payed">work done but not payed</option>
                        <option value="work not done but payed">work not done but payed</option>
                        <option value="not work done and  not payed">not work done and not payed</option>
                    </select>
                </div>
            </div>



            <div class="row">
                <div class="col-md-4">
                    <label for="amt_cfs">Cost CFS</label>
                </div>
                <div class="col-md-4">
                   <input type="number" name="amt_cfs" id="amt_cfs" class="form-control" required>
                </div>
            </div>



            <div class="row">
                <div class="col-md-4">
                    <label for="amt_cfs_status">Cost CFS Status</label>
                </div>
                <div class="col-md-4">
                    <select name="amt_cfs_status" id="amt_cfs_status" class="form-control">
                        <option value="" hidden>select status</option>
                        <option value="work done and payed">work done and payed</option>
                        <option value="work done but not payed">work done but not payed</option>
                        <option value="work not done but payed">work not done but payed</option>
                        <option value="not work done and  not payed">not work done and not payed</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="amt_bo">Cost BO</label>
                </div>
                <div class="col-md-4">

                    <input type="number" name="amt_bo" id="amt_bo" class="form-control">
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="amt_bo_status">Cost BO Status</label>
                </div>
                <div class="col-md-4">
                    <select name="amt_bo_status" id="amt_bo_status" class="form-control">
                        <option value="" hidden>select status</option>
                        <option value="work done and payed">work done and payed</option>
                        <option value="work done but not payed">work done but not payed</option>
                        <option value="work not done but payed">work not done but payed</option>
                        <option value="not work done and  not payed">not work done and not payed</option>
                    </select>
                </div>
            </div>




            <div class="row">
                <div class="col-md-4">
                    <label for="amt_rtu">Cost RTU</label>
                </div>
                <div class="col-md-4">
                    <input type="number" name="amt_rtu" id="amt_rtu" class="form-control">
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="amt_rtu_status">Cost RTU Status</label>
                </div>
                <div class="col-md-4">
                    <select name="amt_rtu_status" id="amt_rtu_status" class="form-control">
                        <option value="" hidden>select status</option>
                        <option value="work done and payed">work done and payed</option>
                        <option value="work done but not payed">work done but not payed</option>
                        <option value="work not done but payed">work not done but payed</option>
                        <option value="not work done and  not payed">not work done and not payed</option>
                    </select>
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="tools">Tools</label>
                </div>
                <div class="col-md-4">
                    <input name="tools" id="tools" type="number" class="form-control">

                </div>
            </div>




            <div class="row">
                <div class="col-md-4">
                    <label for="amt_tools_status">Cost Tools Status</label>
                </div>
                <div class="col-md-4">
                    <select name="amt_tools_status" id="amt_tools_status" class="form-control">
                        <option value="" hidden>select status</option>
                        <option value="work done and payed">work done and payed</option>
                        <option value="work done but not payed">work done but not payed</option>
                        <option value="work not done but payed">work not done but payed</option>
                        <option value="not work done and  not payed">not work done and not payed</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="amt_store_rental">Cost Store Rental</label>
                </div>
                <div class="col-md-4">
                    <input type="number" name="amt_store_rental" id="amt_store_rental" class="form-control">
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="amt_store_rental_status">Cost Store Rental Status</label>

                </div>
                <div class="col-md-4">
                    <select name="amt_store_rental_status" id="amt_store_rental_status" class="form-control">
                        <option value="" hidden>select status</option>
                        <option value="work done and payed">work done and payed</option>
                        <option value="work done but not payed">work done but not payed</option>
                        <option value="work not done but payed">work not done but payed</option>
                        <option value="not work done and  not payed">not work done and not payed</option>
                    </select>

                </div>
            </div>



            <div class="row">
                <div class="col-md-4">
                    <label for="amt_transport">Cost Transport</label>
                </div>
                <div class="col-md-4">
                    <input type="number" name="amt_transport" id="amt_transport"  class="form-control">

                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="amt_transport_status">Cost Transport Status</label>
                </div>
                <div class="col-md-4">
                    <select name="amt_transport_status" id="amt_transport_status" class="form-control">
                        <option value="" hidden>select status</option>
                        <option value="work done and payed">work done and payed</option>
                        <option value="work done but not payed">work done but not payed</option>
                        <option value="work not done but payed">work not done but payed</option>
                        <option value="not work done and  not payed">not work done and not payed</option>
                    </select>

                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="amt_salary">Cost Salary</label>
                </div>
                <div class="col-md-4">
                    <input type="number" name="amt_salary" id="amt_salary" class="form-control">

                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="amt_salary_status">Cost Salary Status</label>
                </div>
                <div class="col-md-4">
                    <select name="amt_salary_status" id="amt_salary_status" class="form-control">
                        <option value="" hidden>select status</option>
                        <option value="work done and payed">work done and payed</option>
                        <option value="work done but not payed">work done but not payed</option>
                        <option value="work not done but payed">work not done but payed</option>
                        <option value="not work done and  not payed">not work done and not payed</option>
                    </select>

                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="total">Total</label>
                </div>
                <div class="col-md-4">
                    <input   type="number" name="total" id="total" class="form-control" readonly>

                </div>
            </div>


            <input type="hidden" name="id_csu_budget" id="id_csu_budget" value="{{$id_tnb}}" class="form-control">
            <div class="text-center">
                <button class="btn btn-success mt-4" style="cursor: pointer !important" type="submit">Submit</button>
            </div>

        </form>
    </div>
        </div></section>
@endsection

@section('script')

<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
    <script>
         var total = 0;
        var pre = 0;
        $(document).ready(function() {

            $("#myForm").validate();
            $("input[type='number']").on('click', function() {
                if (this.value != "") {
                    pre = parseFloat(this.value);
                } else {
                    pre = 0;

                }

            })
            $("input[type='number']").on('change', function() {
                var changeVal = 0;
                if (this.value !== "") {
                    changeVal = parseFloat(this.value);
                }
                total = total + changeVal - pre;
                $('#total').val(total);
            });

        })


    </script>
@endsection