@extends('layouts.app')

@section('content')
    <section class="content-header">

        <div class="row mb-2" style="flex-wrap:nowrap">
            <div class="col-sm-6">
                <h3>CSU Budget TNB</h3>
            </div>
            <div class="col-sm-6 text-right">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{ route('site-data-collection.index') }}">site data</a></li>

                    <li class="breadcrumb-item"><a href="{{ route('csu-budget-tnb.index', $data->pe_name) }}">index</a></li>
                    <li class="breadcrumb-item active">edit</li>
                </ol>
            </div>
        </div>

    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="container bg-white  shadow my-4 " style="border-radius: 10px">


                <form action="{{ route('csu-budget-tnb.update', $data->id) }}" id="myForm" method="post">
                    @csrf
                    @method('PATCH')


                    <div class="row">
                        <div class="col-md-4">
                            <label for="pe_name">Pe Name</label>
                        </div>
                        <div class="col-md-4">
                            <input value="{{ $data->pe_name }}" type="text" name="pe_name" id="pe_name"
                                class="form-control" required readonly>
                        </div>
                    </div>




                    <div class="row">
                        <div class="col-md-4">
                            <label for="kkb">KKB</label>
                        </div>
                        <div class="col-md-4">
                            <input value="{{ $data->kkb }}" type="number" name="kkb" id="kkb"
                                class="form-control" required>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-4">
                            <label for="cfs">CFS</label>
                        </div>
                        <div class="col-md-4">
                            <input value="{{ $data->cfs }}" type="number" name="cfs" id="cfs"
                                class="form-control" required>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-4">
                            <label for="scada">Scada</label>
                        </div>
                        <div class="col-md-4">
                            <input value="{{ $data->scada }}" type="number" name="scada" id="scada"
                                class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="total">Total Budget by TNB</label>
                        </div>
                        <div class="col-md-4">
                            <input value="{{ $data->total }}" type="number" name="total" id="total"
                                class="form-control" readonly>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-md-4">
                            <label for="pe name">Total Budget by Aerosynergy</label>
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="allocated_budget" value="{{ $data->allocated_budget }}"
                                id="allocated_budget" class="form-control" required>
                        </div>
                    </div> --}}

                    <div class="row">
                        <div class="col-md-4">
                            <label for="pe name">Fix Profit Aerosynergy</label>
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="fix_profit" id="fix_profit" value="{{ $data->fix_profit }}"
                                class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="date_time">Date Time</label>
                        </div>
                        <div class="col-md-4">
                            <input value="{{ $data->date_time }}" type="datetime-local" name="date_time" id="date_time"
                                class="form-control">
                        </div>
                    </div>






                    <div class="text-center">
                        <button class="btn btn-success mt-4" style="cursor: pointer !important"
                            type="submit">Update</button>
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
                    pre = parseFloat(this.value);
                } else {
                    pre = 0;

                }

            })
            total = $('#total').val() == "" ? 0 : parseFloat($('#total').val());


            $("input[type='number']").on('change', function() {
                if (this.id != 'allocated_budget') {
                    var changeVal = 0;
                    if (this.value !== "") {
                        changeVal = parseFloat(this.value);
                    }
                    total = total + changeVal - pre;
                    $('#total').val(total);
                }
            });


        })
    </script>
@endsection
