@extends('layouts.app', ['page_title' => 'Index'])
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    <section class="content-header">
        <div class="container-  ">
            <div class="row mb-2" style="flex-wrap:nowrap">
                <div class="col-sm-6">
                    <h3>CSU Budget TNB</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                            <div class="card-title">
                                <a href="{{ route('csu-budget-tnb.create') }}" class="btn  btn-sm"
                                    style="background-color: #367FA9; border-radius:0px; color:white">Add new</a>
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
                                            <th>PE NAME</th>
                                            <th>TOTAL</th>
                                            <th>LAST UPDATE</th>
                                            <th class="text-center">ADD SPENDINGS</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($datas as $data)
                                            <tr>
                                                <td class="align-middle" style="cursor: pointer" onclick="showSpendDetails({{$data->id}})">{{ $data->pe_name }}</td>
                                                <td class="align-middle">{{ $data->total }}</td>
                                                <td class="align-middle">{{ $data->updated_at }}</td>
                                                <td class="text-center">
                                                    @if ($data->csu_spends_count == 0)
                                                        <a class='btn btn-success btn-sm'
                                                            href="{{ route('csu-aero-spend.create', [$data->id, $data->pe_name]) }}">ADD
                                                            SPENDINGS</a>
                                                    @else
                                                        <a class="btn btn-sm btn-secondary"
                                                            href="{{ route('csu-aero-spend.edit', $data->csuSpends->id) }}">Edit
                                                            SPENDINGS</a>
                                                    @endif
                                                </td>


                                                <td class="text-center">
                                                    <button type="button" class="btn  " data-toggle="dropdown">
                                                        <img src="{{ URL::asset('assets/web-images/three-dots-vertical.svg') }}">
                                                    </button>
                                                    <div class="dropdown-menu" role="menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('csu-budget-tnb.edit', $data->id) }}">Edit
                                                            Foam</a>

                                                        <a class="dropdown-item"
                                                            href="{{ route('csu-budget-tnb.show', $data->id) }}">Detail</a>

                                                        <button type="button" class="btn btn-primary dropdown-item"
                                                            data-id="{{ $data->id }}" data-toggle="modal" data-url="csu-budget-tnb"
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
@endsection

@section('script')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>


    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();

            $('#myModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var modal = $(this);
                var url = button.data('url');
                $('#remove-foam').attr('action', url + '/' + id)
            });


            $("#example2").DataTable({
                "lengthChange": false,
                "autoWidth": false,
            })
        })

        function showSpendDetails(id){
            console.log(id);
            $.ajax({
                url: `/csu-aero-spend/index/${id}`,
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
