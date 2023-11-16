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
                    <li class="breadcrumb-item active">create</li>
                </ol>
            </div>
        </div>

    </section>
    <section class="content">
        <div class="container-fluid">
    <div class="container bg-white  shadow my-4 " style="border-radius: 10px">


        <form action="{{ route('vcb-aero-spend.store') }}" id="myForm" method="post">
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
                    <label for="amt_bo">AMT BO</label>
                </div>
                <div class="col-md-4">
                    <input type="number" name="amt_bo" id="amt_bo" class="form-control" required>
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="amt_bo_status">AMT BO Status</label>
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
                    <label for="amt_piw">AMT PIW</label>
                </div>
                <div class="col-md-4">
                    <input type="number" name="amt_piw" id="amt_piw" class="form-control" required>
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="amt_piw_status">AMT PIW Status</label>
                </div>
                <div class="col-md-4">
                    <select name="amt_piw_status" id="amt_piw_status" class="form-control">
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
                    <label for="amt_cable">AMT Cable</label>
                </div>
                <div class="col-md-4">
                    <input type="number" name="amt_cable" id="amt_cable" class="form-control">
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="amt_cable_status">AMT Cable Status</label>
                </div>
                <div class="col-md-4">
                    <select name="amt_cable_status" id="amt_cable_status" class="form-control">
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
                    <label for="amt_transducer">AMT Transducer</label>
                </div>
                <div class="col-md-4">
                    <input type="number" name="amt_transducer" id="amt_transducer" class="form-control">
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="amt_transducer_status">AMT Transducer Status</label>
                </div>
                <div class="col-md-4">
                    <select name="amt_transducer_status" id="amt_transducer_status" class="form-control">
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
                    <label for="amt_rtu">AMT RTU</label>
                </div>
                <div class="col-md-4">
                    <input type="number" name="amt_rtu" id="amt_rtu" class="form-control">
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="amt_rtu_status">AMT RTU Status</label>
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
                    <label for="amt_rtu_cable">AMT RTU Cable</label>
                </div>
                <div class="col-md-4">
                    <input type="number" name="amt_rtu_cable" id="amt_rtu_cable" class="form-control">
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="amt_rtu_cable_status">AMT RTU Cable Status</label>
                </div>
                <div class="col-md-4">
                    <select name="amt_rtu_cable_status" id="amt_rtu_cable_status" class="form-control">
                        <option value="" hidden>select status</option>
                        <option value="work done and payed">work done and payed</option>
                        <option value="work done but not payed">work done but not payed</option>
                        <option value="work not done but payed">work not done but payed</option>
                        <option value="not work done and  not payed">not work done and not payed</option>
                    </select>
                </div>
            </div>

            <input type="hidden" name="id_vcb_budget" id="id_vcb_budget" value="{{$id_tnb}}" class="form-control">

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
                    <label for="amt_tools_status">AMT Tools Status</label>
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
                    <label for="amt_store_rental">AMT Store Rental</label>
                </div>
                <div class="col-md-4">
                    <input type="number" name="amt_store_rental" id="amt_store_rental" class="form-control">
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="amt_store_rental_status">AMT Store Rental Status</label>

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
                    <label for="amt_transport">AMT Transport</label>
                </div>
                <div class="col-md-4">
                    <input type="number" name="amt_transport" id="amt_transport"  class="form-control">

                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="amt_transport_status">AMT Transport Status</label>
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
                    <label for="total">Total</label>
                </div>
                <div class="col-md-4">
                    <input type="number" name="total" id="total" class="form-control" readonly>

                </div>
            </div>






            <div class="text-center">
                <button class="btn btn-success mt-4" style="cursor: pointer !important" type="submit">Submit</button>
            </div>

        </form>
    </div>
        </div>
    </section>
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
                    pre = this.value;
                } else {
                    pre = 0;

                }
                pre = parseFloat(pre);

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
