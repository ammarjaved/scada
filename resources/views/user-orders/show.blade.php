@extends('layouts.app', ['page_title' => 'Index'])
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<style>
    div#myTable_length {
    display: none !important;
}
</style>
    @endsection

@section('content')
    <section class="content-header">
        <div class="container-  ">
            <div class="row mb-2" style="flex-wrap:nowrap">
                <div class="col-sm-6">
                    <h3>Order Detail</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item "><a href="{{ route('admin-order.index') }}">orders</a> </li>
                        <li class="breadcrumb-item active">detail</li>

                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">



            @if (Session::has('failed'))
                <div class="alert {{ Session::get('alert-class', 'alert-secondary') }}" role="alert">
                    {{ Session::get('failed') }}

                    <button type="button" class="close border-0 bg-transparent" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
            @endif
            @if (Session::has('success'))
                <div class="alert {{ Session::get('alert-class', 'alert-success') }}" role="alert">
                    {{ Session::get('success') }}
                    <button type="button" class="close border-0 bg-transparent" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Order Detail
                            </div>

                        </div>

                        <div class="card-body">
                            <div class="my-3">
                                <table>
                                    <tr>
                                        <th>Order no : </th>
                                        <td>{{ $datas->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Username : </th>
                                        <td>{{ $datas->userData->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email : </th>
                                        <td>{{ $datas->userData->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Staus : </th>
                                        <td>{{ $datas->status }}</td>
                                    </tr>
                                </table>



                            </div>
                            <div class="table-responsive">
                                <table id="myTable" class="table table-bordered table-hover">


                                    <thead style="background-color: #E4E3E3 !important">
                                        <tr>
                                            <th>#</th>
                                            <th>Item</th>
                                            <th>Type</th>
                                            <th>unit</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($datas->orderInfo as $data)
                                            <tr>
                                                <td>{{ $loop->index }}</td>
                                                <td class="align-middle">{{ $data->item }}</td>
                                                <td>{{ $data->type }}</td>
                                                <td>{{ $data->unit }}</td>


                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @if ($datas->status == 'Pending')
                                <div class="text-center">
                                    <a href="/order-complete/{{ $datas->id }}"><button class="btn-sm btn-success">Order
                                            Complete</button></a>
                                </div>
                            @endif
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>


    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        })
    </script>
@endsection
