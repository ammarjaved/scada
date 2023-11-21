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
                    <li class="breadcrumb-item"><a href="{{ route('site-data-collection.index' ) }}">site data</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('vcb-budget-tnb.index',$data->VcbBudget->pe_name) }}">index</a></li>
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
                            <td>{{ $data->VcbBudget->pe_name }}</td>
                        </tr>
                        <tr>
                            <th>BUDGET BY TNB : </th>
                            <td><span id="budget"> {{ $data->VcbBudget->total }} </span><strong> (RMB)</strong></td>
                        </tr>
                        <tr>
                            <th>FIX PROFIT :</th>
                            <td><span class="subTotal">{{$data->VcbBudget->fix_profit}}</span> <strong>(RMB) </strong></td>
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
                                'arr' => $count['amt_bo'],
                                'arr_name' => 'amt_bo',
                                'name' => 'BO',
                                'url' => 'vcb',
                                'action' => false
                            ])

                            @include('vcb-aero-spend.detail-table', [
                                'arr' => $count['amt_piw'],
                                'arr_name' => 'amt_piw',
                                'name' => 'PIW',
                                'url' => 'vcb',
                                'action' => false
                            ])

                            @include('vcb-aero-spend.detail-table', [
                                'arr' => $count['amt_cable'],
                                'arr_name' => 'amt_cable',
                                'name' => 'Cable',
                                'url' => 'vcb',
                                'action' => false
                            ])
                             @include('vcb-aero-spend.detail-table', [
                                'arr' => $count['amt_transducer'],
                                'arr_name' => 'amt_transducer',
                                'name' => 'Transducer',
                                'url' => 'vcb',
                                'action' => false
                            ])




                            @include('vcb-aero-spend.detail-table', [
                                'arr' => $count['amt_rtu'],
                                'arr_name' => 'amt_rtu',
                                'name' => 'RTU',
                                'url' => 'vcb',
                                'action' => false
                            ])


                            @include('vcb-aero-spend.detail-table', [
                                'arr' => $count['tools'],
                                'arr_name' => 'tools',
                                'name' => 'Tools',
                                'url' => 'vcb',
                                'action' => false
                            ])


                            @include('vcb-aero-spend.detail-table', [
                                'arr' => $count['amt_store_rental'],
                                'arr_name' => 'amt_store_rental',
                                'name' => 'Store Rental',
                                'url' => 'vcb',
                                'action' => false
                            ])
                            @include('vcb-aero-spend.detail-table', [
                                'arr' => $count['amt_transport'],
                                'arr_name' => 'amt_transport',
                                'name' => 'Transport',
                                'url' => 'vcb',
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

    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content ">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Remove Recored</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="" id="remove-foam" method="POST">
                    @method('DELETE')
                    @csrf

                    <div class="modal-body">
                        Are You Sure ?
                        <input type="hidden" name="id" id="modal-id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-danger">Remove</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
    <script>
        $(document).ready(function() {

            // $("#myForm").validate();
            $('#myModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var modal = $(this);
                var url = button.data('url');
                $('#remove-foam').attr('action', '/vcb-payment-details/' + id)
            });

            $jq('.submit-form').ajaxForm({
                success: function(responseText, status, xhr, $form) {

                        alert("Form submitted successfully!");
                        console.log(responseText.inp_name);
                        formSubmitted(responseText.data.name , responseText.data.sub_total , responseText.data.total)

                },
                error: function(xhr, status, error, $form) {

                    alert("Form submission failed. Please try again.");

                }
            })


        })
        function editDetails(id){
                $(`#${id}-amount`).removeAttr('disabled');
                $(`#${id}-amount`).removeClass('border-0');
                $(`#${id}-status`).removeAttr('disabled');
                $(`#${id}-status`).removeClass('border-0');
                $(`#${id}-description`).removeAttr('disabled');
                $(`#${id}-description`).removeClass('border-0');

                $(`#${id}-submit-button`).removeClass('d-none');
                $(`#${id}-edit-button`).addClass('d-none');


            }

            function formSubmitted(param , subTotal , total){
                $(`#${param}-amount`).attr('disabled',true);
                $(`#${param}-amount`).addClass('border-0');
                $(`#${param}-status`).attr('disabled',true);
                $(`#${param}-status`).addClass('border-0');
                $(`#${param}-description`).attr('disabled',true);
                $(`#${param}-description`).addClass('border-0');

                $(`#${param}-submit-button`).addClass('d-none');
                $(`#${param}-edit-button`).removeClass('d-none');

                $(`#subTotal`).html(subTotal)
                $(`#${param}-total`).html(total)

            }
    </script>
@endsection
