@extends('layouts.app', ['page_title' => 'Index'])
@section('css')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
    <script src="https://malsup.github.io/jquery.form.js"></script>
    <script>
        var $jq = $.noConflict(true);
    </script>
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

      <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <style>
        .error{color: red}
    </style>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-  ">
            <div class="row mb-2" style="flex-wrap:nowrap">
                <div class="col-sm-6">
                    <h3>Payment Summary</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{ route('site-data-collection.index') }}">site data</a></li>
                        <li class="breadcrumb-item active">index</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">


@include('components.messages')



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class=" d-flex justify-content-between">
                               <h5> Payment Summary </h5>
                                <button type="button" class="btn  btn-sm" data-toggle="modal"   data-target="#addPayments"
                                    style="background-color: #367FA9; border-radius:0px; color:white">Add new</button>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="text-end mb-4">

                            </div>

                            <div class="table-responsive">
                                <table id="example2" class="table table-bordered table-hover">


                                    <thead style="background-color: #E4E3E3 !important">
                                        <tr>
                                            <th>RECIVER NAME</th>
                                            <th>PAYMENT TYPE</th>
                                            <th>AMOUNT</th>
                                            <th>DESCRIPTION</th>
                                            <th>DATE TIME</th>
                                            <th>ACTION</th>


                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($datas as $data)
                                            <tr>
                                                <td>{{$data->pmt_receiver_name}}</td>
                                               <td class="align-middle"> {{ $data->pmt_type}}   </td>
                                                <td>{{$data->pmt_amount}}</td>

                                                <td class="col-3">{{$data->description}}</td>
                                                <td>{{$data->date_time}}</td>



                                                <td class="text-center">
                                                    <button type="button" class="btn  " data-toggle="dropdown">
                                                        <img
                                                            src="{{ URL::asset('assets/web-images/three-dots-vertical.svg')  }}">
                                                    </button>
                                                    <div class="dropdown-menu" role="menu">
                                                        <a class="dropdown-item"
                                                            href="#">Edit
                                                            Foam</a>

                                                        {{-- <a class="dropdown-item"
                                                            href="{{ route('rmu-budget-tnb.show', $data->id) }}">Detail</a> --}}

                                                        <button type="button" class="btn btn-primary dropdown-item"
                                                            data-id="{{ $data->id }}" data-toggle="modal" data-url="payment-summary-details"
                                                            data-target="#myModal">
                                                            Remove
                                                        </button>
                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>



                </div>


            </div>

            <div id="tnb-spends" class="mt-4">

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


    <div class="modal fade" id="addPayments">
        <div class="modal-dialog">
            <div class="modal-content " style="border-radius: 0px !important">


                <div class="modal-header" style="background-color: #343A40 ; border-radius:0px ; ">
                    <h6 class="modal-title text-white">Add Payments</h6>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{route('payment-summary-details.store')}}"   method="POST">

                    @csrf

                    <div class="modal-body">

                        <input type="hidden" name="id" id="spending-modal-id">

                        <div class="row">
                            <div class="col-md-4"><label for="total">Name</label></div>
                            <div class="col-md-8">
                                <input type="text"     name="pmt_receiver_name" id="spending-modal-pe-name" required class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><label for="total">Payment Type</label></div>
                            <div class="col-md-8">
                                <select name="pmt_type" id="pmt_name" class="form-control" required>
                                    <option value="" hidden>select</option>
                                    <option value="claim">Claim</option>
                                    <option value="salary">Salary</option>
                                    <option value="tools">Tools</option>
                                    <option value="others">Others</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><label for="amount">Amount</label></div>
                            <div class="col-md-8">
                              <input type="number" name="pmt_amount" id="amount" class="form-control" min="0" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><label for="status">Date Time</label></div>
                            <div class="col-md-8">
                                <input type="datetime-local" name="date_time" id="date_time" class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><label for="description">Description</label></div>
                            <div class="col-md-8">
                                <textarea name="description" id="description" cols="30" rows="8" class="form-control"></textarea>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-success">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>

<!-- SweetAlert2 -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
            // $('#myTable').DataTable();


            var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000
      });

            $("#spendingForm").validate();

            $('#myModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var modal = $(this);
                var url = button.data('url');
                $('#remove-foam').attr('action', '/'+url + '/' + id)
            });

            $('#spendingModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var peName = button.data('name')
                var modal = $(this);
                $('#spending-modal-id').val(id);
                $('#spending-modal-pe-name').val(peName);
             });

             $('#spendingModal').on('hide.bs.modal', function(event) {

                $('#spending-modal-id').val('');
                $('#spending-modal-pe-name').val('');
                $('#description').val('');
                $('#amount').val('');

             });

             $jq('#spendingForm').ajaxForm({
                success: function(responseText, status, xhr, $form) {
                    toastr.success('Spending update successfully!')
                    $('#spendingModal').modal('hide');
                    showSpendDetails(responseText.id)
                },
                error: function(xhr, status, error, $form) {
                    toastr.error('Request failed. Please try again.')

            }

});


            $("#example2").DataTable({
                "lengthChange": false,
                "autoWidth": false,
            })

        })

        function showSpendDetails(id){
            $.ajax({
                url: `/rmu-aero-spend/index/${id}`,
                method: 'GET',
                dataType: 'html',
                success: function(data) {

                    $('#tnb-spends').html(data);
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(xhr.responseText);
                    $('#responseData').html('Error occurred');
                }
            });
        }
    </script>
@endsection