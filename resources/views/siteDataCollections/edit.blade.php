@extends('layout.app', ['page_title' => 'Create'])

@section('content')
    <style>
        input,
        select,
        button {
            margin-bottom: 5%;
            border-radius: 0px !important;
            border: 1px solid #999999 !important;
        }



        #overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            /* Semi-transparent black overlay */
            display: none;
            /* Hide the overlay by default */
            z-index: 9999;
            /* Higher z-index to ensure it displays on top of other content */
        }


        .loading-spinner {

            position: absolute;
            top: 47%;
            left: 42%;
            transform: translate(-50%, -50%);
            width: 45px;
            height: 45px;
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top: 4px solid #264394;
            animation: spin 2s linear infinite;
        }



        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    <div id="overlay">
        <div class="loading-spinner"></div>
    </div>


    <div class="container bg-white  shadow my-4 " style="border-radius: 10px">

        <h3 class="text-center mb-4"> Site Data Collections</h3>
        <form action="{{ route('site-data-collection.update', $data->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')


            <div class="row">

                <div class="col-md-3 ">
                    <label for=""><strong> NAMA PE :</strong></label>
                </div>

                <div class="col-md-4 ">
                    <input type="text" name="nama_pe" id="nama_pe" value="{{ $data->nama_pe }}" class="form-control">
                </div>

            </div>


            <div class="row">

                <div class="col-md-3">
                    <label for="sub_station_type"><strong> SUB-STATION TYPE :</strong></label>
                </div>

                <div class="col-md-4 ">
                    <select name="sub_station_type" id="sub_station_type" class="form-select">
                        <option value="{{ $data->sub_station_type != '' ? $data->sub_station_type : '' }}" hidden>
                            {{ $data->sub_station_type != '' ? $data->sub_station_type : 'Select Type' }}</option>
                        <option value="OUTDOOR">OUTDOOR</option>
                        <option value="ATTACHED">ATTACHED</option>
                        <option value="COMPACT">COMPACT</option>
                        <option value="UNDERGROUND">UNDERGROUND</option>
                        <option value="POLE MOUNT">POLE MOUNT</option>
                        <option value="STANDALONE">STANDALONE</option>
                    </select>
                </div>

            </div>

            <div class="row">

                <div class="col-md-3 align-middle">
                    <label for=""><strong>SWITCHGEAR :</strong></label>
                </div>

                <div class="col-md-4">
                    <select name="switchgear" id="switchgear" class="form-select">
                        <option value="{{ $data->switchgear != '' ? $data->switchgear : '' }}" hidden>
                            {{ $data->switchgear != '' ? $data->switchgear : 'Select' }}</option>
                        <option value="RMU">RMU</option>
                        <option value="VCB">VCB</option>
                        <option value="COMPACT">COMPACT</option>
                    </select>
                </div>


                <div class="col-md-4">

                    <select name="switchgear_2" id="switchgear_2" class="form-select">
                        <option value="{{ $data->switchgear_2 != '' ? $data->switchgear_2 : '' }}" hidden>
                            {{ $data->switchgear_2 != '' ? $data->switchgear_2 : 'Select' }} </option>
                        <option value="MOTORIZED">MOTORIZED</option>
                        <option value="NON MOTORIZED">NON MOTORIZED</option>
                    </select>
                </div>




            </div>

            <div class="row">

                <div class="col-md-3 ">
                    <label for="type_feeder"><strong> TYPE FEEDER</strong></label>
                </div>

                <div class="col-md-4 ">
                    <select name="type_feeder" id="type_feeder" class="form-select">
                        <option value="{{ $data->type_feeder != '' ? $data->type_feeder : '' }}" hidden>
                            {{ $data->type_feeder != '' ? $data->type_feeder : 'Select' }} </option>
                        <option value="2+1">2+1</option>
                        <option value="2+2">2+2</option>
                        <option value="3+1">3+1</option>
                        <option value="3+2">3+2</option>
                        <option value="3s">3s</option>
                        <option value="4s">4s</option>
                        <option value="5s">5s</option>
                        <option value="6s">6s</option>
                        <option value="other">other</option>
                    </select>
                </div>

            </div>


            <div class="row">

                <div class="col-md-3">
                    <label for="switchgear_brand"><strong>SWITCHGEAR BRAND </strong></label>
                </div>

                <div class="col-md-4 ">
                    <input type="text" name="switchgear_brand" value="{{ $data->switchgear_brand }}"
                        id="switchgear_brand" class="form-control">
                </div>

            </div>


            <div class="row">

                <div class="col-md-3 ">
                    <label for="switchgear_no"><strong>SWITCHGEAR NO </strong></label>
                </div>

                <div class="col-md-4">
                    <input type="text" name="switchgear_no" id="switchgear_no" value="{{ $data->switchgear_no }}"
                        class="form-control">
                </div>

            </div>

            <div class="row">

                <div class="col-md-3">
                    <label for="label_switch"><strong>LABEL SWITCH </strong></label>
                </div>

                <div class="col-md-4">
                    <input type="text" name="label_switch" value="{{ $data->label_switch }}" id="label_switch"
                        class="form-control">
                </div>

            </div>

            <div class="row">

                <div class="col-md-3 ">
                    <label for="type_cable"><strong> TYPE CABLE</strong></label>
                </div>

                <div class="col-md-4 ">
                    <select name="type_cable" id="type_cable" class="form-select">
                        <option value="{{ $data->type_cable != '' ? $data->type_cable : '' }}" hidden>
                            {{ $data->type_cable != '' ? $data->type_cable : 'Select' }} </option>
                        <option value="XLPE">XLPE</option>
                        <option value="PILC">PILC</option>
                        <option value="other">other</option>
                    </select>
                </div>

            </div>

            <div class="row">

                <div class="col-md-3 ">
                    <label for="size_cable"><strong> SIZE CABLE </strong></label>
                </div>

                <div class="col-md-4 ">
                    <select name="size_cable" id="size_cable" class="form-select">
                        <option value="{{ $data->size_cable != '' ? $data->size_cable : '' }}" hidden>
                            {{ $data->size_cable != '' ? $data->size_cable : 'Select' }} </option>
                        <option value="240">240</option>
                        <option value="500">500</option>
                        <option value="other">other</option>
                    </select>
                </div>

            </div>

            <div class="row">

                <div class="col-md-3 ">
                    <label for=""><strong>TX RATING </strong></label>
                </div>

                <div class="col-md-4 ">
                    <label for="tx_rating_1"><strong>TX 1</strong></label>
                    <select name="tx_rating_1" id="tx_rating_1" class="form-select">
                        <option value="{{ $data->tx_rating_1 != '' ? $data->tx_rating_1 : '' }}" hidden>
                            {{ $data->tx_rating_1 != '' ? $data->tx_rating_1 : 'Select' }} </option>
                        <option value="300">300</option>
                        <option value="500">500</option>
                        <option value="750">750</option>
                        <option value="1000">1000</option>
                        <option value="other">other</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="tx_rating_2"><strong>TX 2</strong></label>
                    <select name="tx_rating_2" id="tx_rating_2" class="form-select">
                        <option value="{{ $data->tx_rating_2 != '' ? $data->tx_rating_2 : '' }}" hidden>
                            {{ $data->tx_rating_2 != '' ? $data->tx_rating_2 : 'Select' }} </option>
                        <option value="300">300</option>
                        <option value="500">500</option>
                        <option value="750">750</option>
                        <option value="1000">1000</option>
                        <option value="other">other</option>
                    </select>
                </div>

            </div>

            <div class="row">

                <div class="col-md-3 ">
                    <label for=""><strong> TX SIZE CABLE</strong></label>
                </div>

                <div class="col-md-4 ">
                    <label for="tx_cable_1"><strong>TX 1</strong></label>
                    <select name="tx_cable_1" id="tx_cable_1" class="form-select">
                        <option value="{{ $data->tx_cable_1 != '' ? $data->tx_cable_1 : '' }}" hidden>
                            {{ $data->tx_cable_1 != '' ? $data->tx_cable_1 : 'Select' }} </option>
                        <option value="300">70</option>
                        <option value="500">300</option>
                        <option value="750">500</option>
                        <option value="other">other</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="tx_cable_2"><strong>TX 2</strong></label>
                    <select name="tx_cable_2" id="tx_cable_2" class="form-select">
                        <option value="{{ $data->tx_cable_2 != '' ? $data->tx_cable_2 : '' }}" hidden>
                            {{ $data->tx_cable_2 != '' ? $data->tx_cable_2 : 'Select' }} </option>
                        <option value="70">70</option>
                        <option value="300">300</option>
                        <option value="500">500</option>
                        <option value="other">other</option>
                    </select>
                </div>

            </div>


            <div class="row">

                <div class="col-md-3 ">
                    <label for="genset_place"><strong> GENSET PLACE</strong></label>
                </div>

                <div class="col-md-4 ">
                    <select name="genset_place" id="genset_place" class="form-select">
                        <option value="{{ $data->genset_place != '' ? $data->genset_place : '' }}" hidden>
                            {{ $data->genset_place != '' ? $data->genset_place : 'Select' }} </option>
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                        <option value="other">Remarks:</option>
                    </select>
                </div>



            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="ct_cable"><strong>CT CABLE</strong></label>
                </div>
                <div class="col-md-4">
                    <select name="ct_cable" id="ct_cable" class="form-select">
                        <option value="{{ $data->ct_cable != '' ? $data->ct_cable : '' }}" hidden>
                            {{ $data->ct_cable != '' ? $data->ct_cable : 'Select' }} </option>
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                        <option value="other">Remarks:</option>
                    </select>
                </div>
            </div>


            <div class="row">

                <div class="col-md-3 ">
                    <label for="lvdb"><strong> LVDB</strong></label>
                </div>

                <div class="col-md-4 ">
                    <input type="text" name="lvdb" value="{{ $data->lvdb }}" id="lvdb"
                        class="form-control">
                </div>

            </div>


            <div class="row">

                <div class="col-md-3 ">
                    <label for="type_lvdb"><strong> TYPE LVDB</strong></label>
                </div>

                <div class="col-md-4 ">
                    <select name="type_lvdb" id="type_lvdb" class="form-select">
                        <option value="{{ $data->type_lvdb != '' ? $data->type_lvdb : '' }}" hidden>
                            {{ $data->type_lvdb != '' ? $data->type_lvdb : '' }} Select</option>
                        <option value="SUBSTATION">SUBSTATION</option>
                        <option value="CS">CS</option>
                        <option value="SSU">SSU</option>
                        <option value="PAT">PAT</option>
                    </select>
                </div>

            </div>

            <div class="row">

                <div class="col-md-3 ">
                    <label for=""><strong>TYPE FUSE </strong></label>
                </div>

                <div class="col-md-4 ">
                    <select name="type_fuse" id="type_fuse" class="form-select">
                        <option value="{{ $data->type_fuse != '' ? $data->type_fuse : '' }}" hidden>
                            {{ $data->type_fuse != '' ? $data->type_fuse : '' }} Select</option>
                        <option value="DIN-TYPE">DIN-TYPE</option>
                        <option value="J-TYPE">J-TYPE</option>
                    </select>
                </div>

            </div>

            <div class="row">

                <div class="col-md-3 ">
                    <label for="feeder"><strong>FEEDER </strong></label>
                </div>

                <div class="col-md-4 ">
                    <select name="feeder" id="feeder" class="form-select">
                        <option value="{{ $data->feeder != '' ? $data->feeder : '' }}" hidden>
                            {{ $data->feeder != '' ? $data->feeder : '' }}Select</option>
                        <option value="2 IN 8 OUT">2 IN 8 OUT</option>
                        <option value="2 IN 10 OUT">2 IN 10 OUT</option>
                        <option value="2 IN 6 OUT">2 IN 6 OUT</option>
                    </select>
                </div>

            </div>

            <div class="row">

                <div class="col-md-3 ">
                    <label for="rating"><strong>RATING </strong></label>
                </div>

                <div class="col-md-4 ">
                    <select name="rating" id="rating" class="form-select">
                        <option value="{{ $data->rating != '' ? $data->rating : '' }}" hidden>
                            {{ $data->rating != '' ? $data->rating : '' }}Select</option>
                        <option value="1600">1600</option>
                        <option value="800">800</option>
                        <option value="400">400</option>
                    </select>
                </div>

            </div>

            <div class="text-center">
                <button class="btn btn-success mt-4" onclick="showLoading()" style="cursor: pointer !important" type="submit">Submit</button>
            </div>

        </form>
    </div>

    </div>
@endsection

@section('script')
    <script>
        $("select").change(function() {
            var name = '';
            if (this.value == "other") {
                name = this.name
                this.name = ''
                $(this).parent().append(`<input class = "form-control"  name="${name}">`)

            } else {
                var inputElement = $(this).siblings('input');
                if (inputElement.length > 0) {
                    this.name = inputElement.attr('name');
                    inputElement.remove();
                }
            }
        });

        function showLoading() {
            const overlay = document.getElementById('overlay');
    overlay.style.display = 'block';
     
  }
    </script>
@endsection
