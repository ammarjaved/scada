@extends('layout.app', ['page_title' => 'Index'])

@section('content')
    <div class="container bg-white  shadow my-4  index-page">

        <div class="col-md-12 text-center ">

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

        </div>
        <h3 class="text-center">INVENTORY MANAGEMENT</h3>

        <div class="text-end mb-4">
            <a href="{{route('site-data-collection.create')}}" class="btn btn-success btn-sm">Add new</a>
        </div>
        <div class="table-responsive">
            <table id="myTable" class="table   table-hover table-bordered ">


                <thead style="background-color: black !important">
                    <tr>
                        <th>NAMA PE</th>
                        <th>SUB STATION TYPE</th>
                        <th>SWITCHGEAR</th>
                        {{-- <th>TYPE FEEDER</th> --}}
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($datas as $data)
                        <tr>
                            <td class="align-middle">{{ $data->nama_pe ? $data->nama_pe : '-' }}</td>
                            <td class="align-middle">{{ $data->sub_station_type ? $data->sub_station_type : '-' }}</td>
                            <td class="align-middle">{{ $data->switchgear ? $data->switchgear : '- ' }}</td>
                            {{-- <td class="align-middle">{{ $data->type_feeder ? $data->type_feeder : '-' }}</td> --}}
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn" type="button" id="dropdownMenuButton1"
                                        style="cursor: pointer !important; border: 0px !important" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <img src="{{ URL::asset('assets/web-images/three-dots-vertical.svg') }}">
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a href="{{ route('site-data-collection.edit', $data->id) }}"
                                                class="btn  dropdown-item">Edit foam</a></li>
                                        <li><a href="{{ route('update-site-data-images.edit', $data->id) }}"
                                                class="btn  dropdown-item">Edit Images</a></li>

                                        <li><a href="{{ route('site-data-collection.show', $data->id) }}"
                                                class="btn  dropdown-item">Detail</a></li>

                                        <!-- <li><a href="{{ route('site-data-collection.destroy', $data->id) }}"
                                                class="btn btn-sm dropdown-item">Remove</a></li> -->
                                        <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                data-id="{{$data->id}}" data-bs-target="#exampleModal"> Remove </button>
                                        </li>

                                        <li>

                                    </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class=" modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Remove Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" id="remove-foam" method="POST">
                    @method("DELETE")
                    @csrf
                    
                    <div class="modal-body">
                        Are You Sure ?
                        <input type="hidden" name="id" id="modal-id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Remove</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();

            $('#exampleModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var modal = $(this);
                $('#remove-foam').attr('action','site-data-collection/'+id)
            });


        })
    </script>
@endsection
