

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                               <h4>RMU SPENDINGS</h4>
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
                                            <th>UPDATED AT</th>
                                            <th>CREATED AT</th>

                                            {{-- <th>TYPE FEEDER</th> --}}
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($datas as $data)
                                            <tr>
                                                <td class="align-middle">
                                                    {{ $data->RmuBudget->pe_name}}</td>
                                                <td class="align-middle">
                                                    {{ $data->total}}</td>
                                                <td class="align-middle">{{ $data->updated_at }}</td>

                                                <td class="align-middle">{{ $data->created_at }}</td>



                                                {{-- <td class="align-middle">{{ $data->type_feeder ? $data->type_feeder : '-' }}</td> --}}
                                                <td class="text-center">
                                                    <button type="button" class="btn  " data-toggle="dropdown">
                                                        <img
                                                            src="{{ URL::asset('assets/web-images/three-dots-vertical.svg') }}">
                                                    </button>
                                                    <div class="dropdown-menu" role="menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('rmu-aero-spend.edit', $data->id) }}">Edit
                                                            Foam</a>

                                                        <a class="dropdown-item"
                                                            href="{{ route('rmu-aero-spend.show', $data->id) }}">Detail</a>

                                                        <button type="button" class="btn btn-primary dropdown-item"
                                                            data-id="{{ $data->id }}" data-url={{"rmu-aero-spend"}} data-toggle="modal"
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
        </div>
    </section>
