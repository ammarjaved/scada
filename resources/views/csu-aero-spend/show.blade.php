@extends('layouts.app')
@section('css')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
<script src="https://malsup.github.io/jquery.form.js"></script>
<script>
    var $jq = $.noConflict(true);
</script>
<style>
    input ,textarea, select {
    font-size: 15px !important;
    padding: 0px 6px !important;

}
</style>
@endsection

@section('content')
    <section class="content-header">

        <div class="row mb-2" style="flex-wrap:nowrap">
            <div class="col-sm-6">
                <h3>VCB AERO Spend</h3>
            </div>
            <div class="col-sm-6 text-right">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{ route('csu-budget-tnb.index') }}">index</a></li>
                    <li class="breadcrumb-item active">edit</li>
                </ol>
            </div>
        </div>

    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="container- p-5 m-4 bg-white  shadow my-4 " style="border-radius: 10px">
                <table class=" mb-3 table-borderless col-md-3">
                    <tbody>
                        <tr>
                            <th>PE NAME : </th>
                            <td>{{ $data->CsuBudget->pe_name }}</td>
                        </tr>
                        <tr>
                            <th>ALLOCATED BUDGET : </th>
                            <td><span id="budget"> {{ $data->CsuBudget->allocated_budget }} </span><strong> (RMB)</strong></td>
                        </tr>
                        <tr>
                            <th>TOTAL SPENDING :</th>
                            <td><span class="subTotal">{{$data->total}}</span> <strong>(RMB) </strong></td>
                        </tr>
                        <tr>
                            <th>TOTAL PROFIT :</th>
                            <td><span class="total_profit">{{$data->profit}} </span><strong>%</strong></td>
                        </tr>
                    </tbody>
                </table>
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered ">
                        <thead style="background-color: #E4E3E3 !important">
                            <th>NAME</th>
                          <th class="text-center">DETAIL</th>
                        </thead>
                        <tbody>



                            @include('vcb-aero-spend.detail-table', [
                                'arr' => $count['amt_kkb'],
                                'arr_name' => 'amt_kkb',
                                'name' => 'KKB',
                                'url' => 'csu',
                                'action' => true
                            ])

                            @include('vcb-aero-spend.detail-table', [
                                'arr' => $count['amt_cfs'],
                                'arr_name' => 'amt_cfs',
                                'name' => 'CFS',
                                'url' => 'csu',
                                'action' => true
                            ])

                            @include('vcb-aero-spend.detail-table', [
                                'arr' => $count['amt_bo'],
                                'arr_name' => 'amt_bo',
                                'name' => 'BO',
                                'url' => 'csu',
                                'action' => true
                            ])
                             @include('vcb-aero-spend.detail-table', [
                                'arr' => $count['amt_rtu'],
                                'arr_name' => 'amt_rtu',
                                'name' => 'RTU',
                                'url' => 'csu',
                                'action' => true
                            ])




                            @include('vcb-aero-spend.detail-table', [
                                'arr' => $count['tools'],
                                'arr_name' => 'tools',
                                'name' => 'Tools',
                                'url' => 'csu',
                                'action' => true
                            ])


                            @include('vcb-aero-spend.detail-table', [
                                'arr' => $count['amt_store_rental'],
                                'arr_name' => 'amt_store_rental',
                                'name' => 'Store Rental',
                                'url' => 'csu',
                                'action' => true
                            ])


                            @include('vcb-aero-spend.detail-table', [
                                'arr' => $count['amt_transport'],
                                'arr_name' => 'amt_transport',
                                'name' => 'Transport',
                                'url' => 'csu',
                                'action' => true
                            ])
                            @include('vcb-aero-spend.detail-table', [
                                'arr' => $count['amt_salary'],
                                'arr_name' => 'amt_salary',
                                'name' => 'Salray',
                                'url' => 'csu',
                                'action' => true
                            ])





                        </tbody>
                        <tfoot style="background-color: #E4E3E3 !important">

                            <td colspan="2" class="text-end"><strong>Total : <span id="subTotal">{{ $data->total }}</span></strong></td>
                        </tfoot>
                    </table>
                </div>



            </div>
        </div>
    </section>


@endsection
