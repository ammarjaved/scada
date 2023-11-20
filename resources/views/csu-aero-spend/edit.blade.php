@extends('layouts.app')
@section('css')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
<script src="https://malsup.github.io/jquery.form.js"></script>

   <!-- SweetAlert2 -->
   <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
   <!-- Toastr -->
   <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
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
                <h3>CSU AERO Spend</h3>
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
    <!-- SweetAlert2 -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <script>
        var budget = 0;
        $(document).ready(function() {


            var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000
      });

            // $("#myForm").validate();
            $('#myModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var modal = $(this);
                var url = button.data('url');
                $('#remove-foam').attr('action', '/csu-payment-details/' + id)
            });

            $jq('.submit-form').ajaxForm({
                success: function(responseText, status, xhr, $form) {

                        toastr.success('Spending update successfully!')

                        formSubmitted(responseText.data.name , responseText.data.sub_total , responseText.data.total)

                },
                error: function(xhr, status, error, $form) {

                    toastr.error('Request failed. Please try again.')

                }
            })

            budget = {{ $data->CsuBudget->allocated_budget }};



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

                $(`.subTotal`).html(subTotal)
            $(`#${param}-total`).html(total)
            var  profit = (((budget - subTotal)/budget)*100).toFixed(2);
            $(`.total_profit`).html(profit)

            }
    </script>
@endsection
