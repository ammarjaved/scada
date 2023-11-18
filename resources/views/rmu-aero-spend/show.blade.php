@extends('layouts.app')

@section('content')
    <section class="content-header">

        <div class="row mb-2" style="flex-wrap:nowrap">
            <div class="col-sm-6">
                <h3>RMU AERO Spend</h3>
            </div>
            <div class="col-sm-6 text-right">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{ route('rmu-budget-tnb.index') }}">index</a></li>
                    <li class="breadcrumb-item active">show</li>
                </ol>
            </div>
        </div>

    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="container- p-5 m-4 bg-white  shadow my-4 " style="border-radius: 10px">

                <div class="table-responsive">
                    <table id="example2" class="table table-bordered ">
                        <thead style="background-color: #E4E3E3 !important">
                            <th>NAME</th>
                            <th>COSTS</th>
                            <th>STATUS</th>
                            <th>DESCRIPTION</th>
                        </thead>
                        <tbody>
                        {{-- <tr>
                            <th>PE NAME</th>
                            <td colspan="3">{{ $data->RmuBudget->pe_name }}</td>
                        </tr> --}}

                        @include('rmu-aero-spend.detail-component', [
                            'arr' => $count['amt_kkb'],
                            'rowCount' => $count['amt_kkb_count'],
                            'name' => 'KKB',
                        ])

                        @include('rmu-aero-spend.detail-component', [
                            'arr' => $count['amt_ir'],
                            'rowCount' => $count['amt_ir_count'],
                            'name' => 'IR',
                        ])

                        @include('rmu-aero-spend.detail-component', [
                            'arr' => $count['amt_bo'],
                            'rowCount' => $count['amt_bo_count'],
                            'name' => 'BO',
                        ])

                        @include('rmu-aero-spend.detail-component', [
                            'arr' => $count['amt_piw'],
                            'rowCount' => $count['amt_piw_count'],
                            'name' => 'PIW',
                        ])

                        @include('rmu-aero-spend.detail-component', [
                            'arr' => $count['amt_cable'],
                            'rowCount' => $count['amt_cable_count'],
                            'name' => 'Cable',
                        ])

                        @include('rmu-aero-spend.detail-component', [
                            'arr' => $count['amt_rtu'],
                            'rowCount' => $count['amt_rtu_count'],
                            'name' => 'RTU',
                        ])
                        @include('rmu-aero-spend.detail-component', [
                            'arr' => $count['amt_rtu_cable'],
                            'rowCount' => $count['amt_rtu_cable_count'],
                            'name' => 'RTU Cable',
                        ])

                        @include('rmu-aero-spend.detail-component', [
                            'arr' => $count['tools'],
                            'rowCount' => $count['tools_count'],
                            'name' => 'Tools',
                        ])


                        @include('rmu-aero-spend.detail-component', [
                            'arr' => $count['amt_store_rental'],
                            'rowCount' => $count['amt_store_rental_count'],
                            'name' => 'Store Rental',
                        ])
                        @include('rmu-aero-spend.detail-component', [
                            'arr' => $count['amt_transport'],
                            'rowCount' => $count['amt_transport_count'],
                            'name' => 'Transport',
                        ])



</tbody>
                    </table>
                </div>



            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
    <script>
        $(document).ready(function() {

            $("#myForm").validate();


        })
    </script>
@endsection
