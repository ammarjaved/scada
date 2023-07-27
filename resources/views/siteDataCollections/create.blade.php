@extends('layout.app', ['page_title' => 'Create'])

@section('content')
    
<style>
    #overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.6); /* Semi-transparent black overlay */
  display: none; /* Hide the overlay by default */
  z-index: 9999; /* Higher z-index to ensure it displays on top of other content */
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
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
  </style>


  <div id="overlay">
    <div class="loading-spinner"></div>
  </div>

  

    <div class="container bg-white  shadow my-4 " style="border-radius: 10px">

        <h3 class="text-center mb-4"> Site Data Collections</h3>
        <form action="{{ route('site-data-collection.store')}}" method="post"  enctype="multipart/form-data">
            @csrf


            <div class="row">

                <div class="col-md-3 ">
                    <label for=""><strong> NAMA PE :</strong></label>
                </div>

                <div class="col-md-4 ">
                    <input type="text" name="nama_pe" id="nama_pe" class="form-control">
                </div>

            </div>


            <div class="row">

                <div class="col-md-3">
                    <label for="sub_station_type"><strong> SUB-STATION TYPE :</strong></label>
                </div>

                <div class="col-md-4 ">
                    <select name="sub_station_type" id="sub_station_type" class="form-select">
                        <option value="" hidden>Select Type</option>
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
                        <option value="" hidden> Select</option>
                        <option value="RMU">RMU</option>
                        <option value="VCB">VCB</option>
                        <option value="COMPACT">COMPACT</option>
                    </select>
                </div>


                <div class="col-md-4">

                    <select name="switchgear_2" id="switchgear_2" class="form-select">
                        <option value="" hidden> Select</option>
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
                        <option value="" hidden> Select </option>
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
                    <input type="text" name="switchgear_brand" id="switchgear_brand" class="form-control">
                </div>

            </div>


            <div class="row">

                <div class="col-md-3 ">
                    <label for="switchgear_no"><strong>SWITCHGEAR NO </strong></label>
                </div>

                <div class="col-md-4">
                    <input type="text" name="switchgear_no" id="switchgear_no" class="form-control">
                </div>

            </div>

            <div class="row">

                <div class="col-md-3">
                    <label for="label_switch"><strong>LABEL SWITCH </strong></label>
                </div>

                <div class="col-md-4">
                    <input type="text" name="label_switch" id="label_switch" class="form-control">
                </div>

            </div>

            <div class="row">

                <div class="col-md-3 ">
                    <label for="type_cable"><strong> TYPE CABLE</strong></label>
                </div>

                <div class="col-md-4 ">
                    <select name="type_cable" id="type_cable" class="form-select">
                        <option value="" hidden> Select </option>
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
                        <option value="" hidden> Select </option>
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
                        <option value="" hidden> Select </option>
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
                        <option value="" hidden> Select </option>
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
                        <option value="" hidden> Select </option>
                        <option value="300">70</option>
                        <option value="500">300</option>
                        <option value="750">500</option>
                        <option value="other">other</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="tx_cable_2"><strong>TX 2</strong></label>
                    <select name="tx_cable_2" id="tx_cable_2" class="form-select">
                        <option value="" hidden> Select </option>
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
                        <option value="" hidden> Select </option>
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
                        <option value="" hidden> Select </option>
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                        <option value="other">Remarks:</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="depan_pe"><strong> DEPAN PE</strong></label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[depan_pe]" id="depan_pe" class="form-control">
                </div>
                <div class="col-md-4"></div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="full_switchgear"><strong> FULL SWITHCGEAR</strong></label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[full_switchgear]" id="full_switchgear" class="form-control">
                </div>
                <div class="col-md-4"></div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="full_tx1">FULL TX 1</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[full_tx1]" id="full_tx1" class="form-control">
                </div>
                <div class="col-md-4"></div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="full_tx2">FULL TX 2</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[full_tx2]" id="full_tx2" class="form-control">
                </div>
                <div class="col-md-4"></div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="full_lvdb">FULL LVDB</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[full_lvdb]" id="full_lvdb" class="form-control">
                </div>
                <div class="col-md-4"></div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="kiri_pe">KIRI PE</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[kiri_pe]" id="kiri_pe" class="form-control">
                </div>
                <div class="col-md-4"></div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="plate1">PLATE 1</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[plate1]" id="plate1" class="form-control">
                </div>
                <div class="col-md-4"></div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="plate_2">PLATE 2</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[plate2]" id="plate2" class="form-control">
                </div>
                <div class="col-md-4"></div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="plate3">PLATE 3</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[plate3]" id="plate3" class="form-control">
                </div>
                <div class="col-md-4"></div>
            </div>

            <!-- Add the rest of the input:file elements in a similar manner -->
            <div class="row">
                <div class="col-md-3">
                    <label for="plate_lvdb">PLATE LVDB</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[plate_lvdb]" id="plate_lvdb" class="form-control">
                </div>
                <div class="col-md-4"></div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="kanan_pe">KANAN PE</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[kanan_pe]" id="kanan_pe" class="form-control">
                </div>
                <div class="col-md-4"></div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="sisi_kiri">SISI KIRI</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[sisi_kiri]" id="sisi_kiri" class="form-control">
                </div>
                <div class="col-md-4"></div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="sisi_cable_kanan1">SISI CABLE KANAN 1</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[sisi_cable_kanan1]" id="sisi_cable_kanan1" class="form-control">
                </div>
                <div class="col-md-4"></div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="sisi_cable_kanan2">SISI CABLE KANAN 2</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[sisi_cable_kanan2]" id="sisi_cable_kanan2" class="form-control">
                </div>
                <div class="col-md-4"></div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="full_feeder">FULL FEEDER</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[full_feeder]" id="full_feeder" class="form-control">
                </div>
                <div class="col-md-4"></div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="pintu_pe">PINTU PE</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[pintu_pe]" id="pintu_pe" class="form-control">
                </div>
                <div class="col-md-4"></div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="sisi_kanan">SISI KANAN</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[sisi_kanan]" id="sisi_kanan" class="form-control">
                </div>
                <div class="col-md-4"></div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="sisi_cable_kiri1">SISI CABLE KIRI 1</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[sisi_cable_kiri1]" id="sisi_cable_kiri1" class="form-control">
                </div>
                <div class="col-md-4"></div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="sisi_cable_kiri2">SISI CABLE KIRI 2</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[sisi_cable_kiri2]" id="sisi_cable_kiri2" class="form-control">
                </div>
                <div class="col-md-4"></div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="tagging">TAGGING</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[tagging]" id="tagging" class="form-control">
                </div>
                <div class="col-md-4"></div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="board_pe">BOARD PE</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[board_pe]" id="board_pe" class="form-control">
                </div>
                <div class="col-md-4"></div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="bawah_nampak_cable">BAWAH (NAMPAK CABLE)</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[bawah_nampak_cable]" id="bawah_nampak_cable" class="form-control">
                </div>
                <div class="col-md-4"></div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="atas1">ATAS 1</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[atas1]" id="atas1" class="form-control">
                </div>
                <div class="col-md-4"></div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="atas2">ATAS 2</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[atas2]" id="atas2" class="form-control">
                </div>
                <div class="col-md-4"></div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="full_depan_pe">FULL DEPAN PE</label>
                </div>
                <div class="col-md-4">
                    <input type="file" name="image[full_depan_pe]" id="full_depan_pe" class="form-control">
                </div>
                <div class="col-md-4"></div>
            </div>
            <div class="row">

                <div class="col-md-3 ">
                    <label for="lvdb"><strong> LVDB</strong></label>
                </div>

                <div class="col-md-4 ">
                    <input type="text" name="lvdb" id="lvdb" class="form-control">
                </div>

            </div>


            <div class="row">

                <div class="col-md-3 ">
                    <label for="type_lvdb"><strong> TYPE LVDB</strong></label>
                </div>

                <div class="col-md-4 ">
                    <select name="type_lvdb" id="type_lvdb" class="form-select">
                        <option value=""> Select</option>
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
                        <option value="type_fuse"> Select</option>
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
                        <option value=""> Select</option>
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
                        <option value=""> Select</option>
                        <option value="1600">1600</option>
                        <option value="800">800</option>
                        <option value="400">400</option>
                    </select>
                </div>

            </div>

            <div class="text-center">
                <button class="btn btn-success mt-4" onclick="showLoading()" style="cursor: pointer !important"
                    type="submit">Submit</button>
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
