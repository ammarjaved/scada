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
                    <li class="breadcrumb-item active">edit</li>
                </ol>
            </div>
        </div>

    </section>
    <section class="content">
        <div class="container-fluid">
    <div class="container bg-white  shadow my-4 " style="border-radius: 10px">


        <form action="{{ route('vcb-aero-spend.update',$data->id) }}" id="myForm" method="post">
            @csrf
            @method('PATCH')



            <div class="row">
                <div class="col-md-4">
                    <label for="amt_kkb">PE NAME</label>
                </div>
                <div class="col-md-4">
                   <input value="{{$data->VcbBudget->pe_name}}" type="text" name="pe_name" id="pe_name" class="form-control" required readonly>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="amt_bo">Cost BO</label>
                </div>
                <div class="col-md-4">
                    <input value="{{$data->amt_bo}}" type="number" name="amt_bo" id="amt_bo" class="form-control" >
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="amt_bo_status">Cost BO Status</label>
                </div>
                <div class="col-md-4">
                    <select name="amt_bo_status" id="amt_bo_status" class="form-control">
                        <option value="{{$data->amt_bo_status}}" hidden>{{$data->amt_bo_status  == "" ? "select status" : $data->amt_bo_status}}</option>
                        <option value="work done and payed">work done and payed</option>
                        <option value="work done but not payed">work done but not payed</option>
                        <option value="work not done but payed">work not done but payed</option>
                        <option value="not work done and  not payed">not work done and not payed</option>
                    </select>
                </div>
            </div>



            <div class="row">
                <div class="col-md-4">
                    <label for="amt_piw">Cost PIW</label>
                </div>
                <div class="col-md-4">
                    <input value="{{$data->amt_piw}}" type="number" name="amt_piw" id="amt_piw" class="form-control" >
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="amt_piw_status">Cost PIW Status</label>
                </div>
                <div class="col-md-4">
                    <select name="amt_piw_status" id="amt_piw_status" class="form-control">
                        <option value="{{$data->amt_piw_status}}" hidden>{{$data->amt_piw_status  == "" ? "select status" : $data->amt_piw_status}}</option>
                        <option value="work done and payed">work done and payed</option>
                        <option value="work done but not payed">work done but not payed</option>
                        <option value="work not done but payed">work not done but payed</option>
                        <option value="not work done and  not payed">not work done and not payed</option>
                    </select>
                </div>
            </div>





            <div class="row">
                <div class="col-md-4">
                    <label for="amt_cable">Cost Cable</label>
                </div>
                <div class="col-md-4">
                    <input value="{{$data->amt_cable}}" type="number" name="amt_cable" id="amt_cable" class="form-control">
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="amt_cable_status">Cost Cable Status</label>
                </div>
                <div class="col-md-4">
                    <select name="amt_cable_status" id="amt_cable_status" class="form-control">
                        <option value="{{$data->amt_cable_status}}" hidden>{{$data->amt_cable_status  == "" ? "select status" : $data->amt_cable_status}}</option>
                        <option value="work done and payed">work done and payed</option>
                        <option value="work done but not payed">work done but not payed</option>
                        <option value="work not done but payed">work not done but payed</option>
                        <option value="not work done and  not payed">not work done and not payed</option>
                    </select>
                </div>
            </div>



            <div class="row">
                <div class="col-md-4">
                    <label for="amt_transducer">Cost Transducer</label>
                </div>
                <div class="col-md-4">
                    <input value="{{$data->amt_transducer}}" type="number" name="amt_transducer" id="amt_transducer" class="form-control">
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="amt_transducer_status">Cost Transducer Status</label>
                </div>
                <div class="col-md-4">
                    <select name="amt_transducer_status" id="amt_transducer_status" class="form-control">
                        <option value="{{$data->amt_transducer_status}}" hidden>{{$data->amt_transducer_status  == "" ? "select status" : $data->amt_transducer_status}}</option>
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
                    <input value="{{$data->amt_rtu}}" type="number" name="amt_rtu" id="amt_rtu" class="form-control">
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="amt_rtu_status">Cost RTU Status</label>
                </div>
                <div class="col-md-4">
                    <select name="amt_rtu_status" id="amt_rtu_status" class="form-control">
                        <option value="{{$data->amt_rtu_status}}" hidden>{{$data->amt_rtu_status  == "" ? "select status" : $data->amt_rtu_status}}</option>
                        <option value="work done and payed">work done and payed</option>
                        <option value="work done but not payed">work done but not payed</option>
                        <option value="work not done but payed">work not done but payed</option>
                        <option value="not work done and  not payed">not work done and not payed</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="amt_rtu_cable">Cost RTU Cable</label>
                </div>
                <div class="col-md-4">
                    <input value="{{$data->amt_rtu_cable}}" type="number" name="amt_rtu_cable" id="amt_rtu_cable" class="form-control">
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="amt_rtu_cable_status">Cost RTU Cable Status</label>
                </div>
                <div class="col-md-4">
                    <select name="amt_rtu_cable_status" id="amt_rtu_cable_status" class="form-control">
                        <option value="{{$data->amt_rtu_cable_status}}" hidden>{{$data->amt_rtu_cable_status  == "" ? "select status" : $data->amt_rtu_cable_status}}</option>
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
                    <input value="{{$data->tools}}" name="tools" id="tools" type="number" class="form-control">

                </div>
            </div>




            <div class="row">
                <div class="col-md-4">
                    <label for="amt_tools_status">Cost Tools Status</label>
                </div>
                <div class="col-md-4">
                    <select name="amt_tools_status" id="amt_tools_status" class="form-control">
                        <option value="{{$data->amt_tools_status}}" hidden>{{$data->amt_tools_status  == "" ? "select status" : $data->amt_tools_status}}</option>
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
                    <input value="{{$data->amt_store_rental}}" type="number" name="amt_store_rental" id="amt_store_rental" class="form-control">
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <label for="amt_store_rental_status">Cost Store Rental Status</label>

                </div>
                <div class="col-md-4">
                    <select name="amt_store_rental_status" id="amt_store_rental_status" class="form-control">
                        <option value="{{$data->amt_store_rental_status}}" hidden>{{$data->amt_store_rental_status  == "" ? "select status" : $data->amt_store_rental_status}}</option>
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
                    <input value="{{$data->amt_transport}}" type="number" name="amt_transport" id="amt_transport"  class="form-control">

                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label for="amt_transport_status">Cost Transport Status</label>
                </div>
                <div class="col-md-4">
                    <select name="amt_transport_status" id="amt_transport_status" class="form-control">
                        <option value="{{$data->amt_transport_status}}" hidden>{{$data->amt_transport_status  == "" ? "select status" : $data->amt_transport_status}}</option>
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
                    <input value="{{$data->total}}" type="number" name="total" id="total" class="form-control" readonly>

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
            total = $('#total').val() == "" ? 0 : parseFloat($('#total').val());


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
