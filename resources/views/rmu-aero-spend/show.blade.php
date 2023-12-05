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
                <h3>RMU AERO Spend</h3>
            </div>
            <div class="col-sm-6 text-right">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{ route('site-data-collection.index' ) }}">site data</a></li>

                    <li class="breadcrumb-item"><a href="{{ route('rmu-budget-tnb.index' ,   $data->RmuBudget->pe_name  ) }}">index</a></li>
                    <li class="breadcrumb-item active">show</li>
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
                            <td>{{ $data->RmuBudget->pe_name }}</td>
                        </tr>
                        
                        <tr>
                            <th>BUDGET BY TNB : </th>

                            <td><span id="budget"> {{ $data->RmuBudget->total }} </span><strong> (RMB)</strong></td>
                        </tr>
                        <tr>
                            <th>FIX PROFIT :</th>
                            <td> {{$data->RmuBudget->fix_profit}} <strong>(RMB) </strong></td>
                        </tr>
                        <tr>
                            <th>TOTAL SPENDING :</th>
                            <td><span class="subTotal">{{$data->total}}</span> <strong>(RMB) </strong></td>
                        </tr>
                        <tr>
                            <th>TOTAL PENDING :</th>
                            <td><span class="pending">{{$data->pending_payment}}</span> <strong>(RMB) </strong></td>
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

                            {{-- @foreach ($count as $key => $itm)

                                {{$key}}
                            @endforeach --}}


                            @include('components.detail-table', [
                                'arr' => $count['amt_kkb'],
                                'arr_name' => 'amt_kkb',
                                'name' => 'KKB',
                                'url' => 'rmu',
                                'action' => false
                            ])

                            @include('components.detail-table', [
                                'arr' => $count['amt_pk'],
                                'arr_name' => 'amt_pk',
                                'name' => 'PK',
                                'url' => 'rmu',
                                'action' => false
                            ])



                            @include('components.detail-table', [
                                'arr' => $count['amt_ir'],
                                'arr_name' => 'amt_ir',
                                'name' => 'IR',
                                'url' => 'rmu',
                                'action' => false
                            ])

                            @include('components.detail-table', [
                                'arr' => $count['amt_bo'],
                                'arr_name' => 'amt_bo',
                                'name' => 'BO',
                                'url' => 'rmu',
                                'action' => false
                            ])
                             @include('components.detail-table', [
                                'arr' => $count['amt_piw'],
                                'arr_name' => 'amt_piw',
                                'name' => 'PIW',
                                'url' => 'rmu',
                                'action' => false
                            ])

@include('components.detail-table', [
    'arr' => $count['amt_cable'],
    'arr_name' => 'amt_cable',
    'name' => 'Cable',
    'url' => 'rmu',
                                'action' => false
])




                            @include('components.detail-table', [
                                'arr' => $count['amt_rtu'],
                                'arr_name' => 'amt_rtu',
                                'name' => 'RTU',
                                'url' => 'rmu',
                                'action' => false
                            ])

@include('components.detail-table', [
                                'arr' => $count['amt_rtu_cable'],
                                'arr_name' => 'amt_rtu_cable',
                                'name' => 'RTU Cable',
                                'url' => 'rmu',
                                'action' => false
                            ])


                            @include('components.detail-table', [
                                'arr' => $count['tools'],
                                'arr_name' => 'tools',
                                'name' => 'Tools',
                                'url' => 'rmu',
                                'action' => false
                            ])


                            @include('components.detail-table', [
                                'arr' => $count['amt_store_rental'],
                                'arr_name' => 'amt_store_rental',
                                'name' => 'Store Rental',
                                'url' => 'rmu',
                                'action' => false
                            ])
                            @include('components.detail-table', [
                                'arr' => $count['amt_transport'],
                                'arr_name' => 'amt_transport',
                                'name' => 'Transport',
                                'url' => 'rmu',
                                'action' => false
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
