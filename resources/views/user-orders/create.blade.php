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
                    <h3>Place Order</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">create</li>
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
                        <div class="card-header text-right">

                            <button type="button" class="btn btn-sm" style="background-color: #367FA9 ; color:white"
                                data-toggle="modal" onclick="addRow()" data-target="#addData">
                                Add Row
                            </button>


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('order.store') }}" onsubmit="return submitFoam()" method="post">
                                @csrf
                                <div class="table-responsive">


                                    <table id="order-table" class="table table-bordered table-hover">


                                        <thead style="background-color: #E4E3E3 !important">

                                            <th>#</th>
                                            <th>ITEM</th>
                                            <th>DESCRIPTION</th>
                                            <th>UNIT</th>
                                            <th>REMOVE</th>

                                        </thead>
                                        <tbody>


                                        </tbody>
                                    </table>




                                </div>

                                <div class="text-center">
                                    <button class="btn btn-sm btn-success">
                                        Plcae Order
                                    </button>
                                </div>
                            </form>
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
        var orderCount = 1;
        $(document).ready(function() {
            addRow()
        })

        function selectItem(event) {
            var typeValue = [];

            $(event).parent().next().children().find('option').remove().end();

            if (event.value === 'CABLE FOR PIW VCB') {

                typeValue = ['19cx1.5mm (Cu/PVC/PVC/SWA/PVC) amoured',
                    '4cx1.5mm (Cu/PVC/PVC/SWA/PVC) amoured', '4cx1.0mm (Cu/PVC/PVC) non amoured',
                    '3cx2.5mm (Cu/PVC/PVC/SWA/PVC) amoured', '2cx4mm (Cu/PVC/PVC/SWA/PVC) amoured',
                    '2cx1.5mm (Cu/PVC/PVC) non amoured', '2pr x 1.5mm (Cu/PVC/PVC/SWA/PVC) amoured',
                    '4cx4mm (Cu/PVC/PVC/SWA/PVC) amoured', '3cx2.5mm (Cu/PVC/PVC) non- amoured',
                    '2cx2.5mm (Cu/PVC/PVC) amoured', '1C X 6MM FLEXIBLE (GREEN)(earthing)',
                    '1C X 2.5MM FLEXIBLE (GREEN)(lopping earthag)',
                    '1C X 4MM FLEXIBLE (YELLOW)(C.T cable)',
                    '1C X 2.5MM FLEXIBLE (GREY)(control panel)',
                    '1C X 4MM FLEXIBLE (BLACK) (C.T cable)'
                ];

            } else if (event.value === "CABLE FOR RTU / VCB") {

                typeValue = ['19 CORE x 1.0MM ARM (RTU-RCB)', '2 CORE x 4 MM ARM (BC-RTU)',
                    '3 CORE x 2.5 MM NON ARM (DB-RTU)(AC CABLE)', '1 CORE X 50 MM (earthing)',
                    '10 PAIR X 1.0 MM ARM', '40 CORE X 1.0 MM ARM'
                ];

            } else if (event.value === 'TRANSDUCER') {

                typeValue = ['CURRENT TRANSDUCER'];

            } else if (event.value === "MCB") {

                typeValue = ['MCB 2P 20A (Average 5 nos for power)',
                    'MCB 2P 6A (Average 2 nos for lighting)', 'RCCB 60 A SINGLE PHASE'
                ];
            } else if (event.value === "SELECTOR SWITCH") {
                typeValue = ['SWITCH LOCAL REMOTE (KRAUS NAIMER & SALZER BRAND)',
                    'TRIP CLOSED (ABB OLD Model)'
                ];
            } else if (event.value === "EFI BASE PLATE") {
                typeValue = ['BASE EFI 14" X 15"'];
            } else if (event.value === "TERMINAL BLOCKS") {
                typeValue = ['TERMINAL BLOCKS KNIFE (4MM)', 'TERMINAL BLOCKS SLIDING (6MM)',
                    'END STOPPER', 'END SECTION 62 (4MM)', 'END SECTION T2 (6MM)',
                    'ALUMINIUM DIN RAIL 40MM 1 METER'
                ];
            } else if (event.value === "CABLE UG") {
                typeValue = ['BLADE TERMINAL 2.5mm BLUE', 'BLADE TERMINAL 1.5mm RED',
                    'CORD END 1.5mm RED (PIW)', 'CORD END 1.5mm RED (RTU)',
                    'CORD END 1.0mm RED (PIW)', 'CORD END 1.0mm RED (RTU)',
                    'PIN TERMINAL 4mm YELLOW', 'O LUG (RVE 2-6) 2.5mm BLUE (PIW)',
                    'O LUG (RVE 2-6) 2.5mm BLUE (RTU)',
                    'O LUG (RVE 2-4) 2.5mm BLUE', 'O LUG 4mm YELLOW', 'Y LUG 2.5mm BLUE',
                    'Y LUG 1.5mm RED', 'Y LUG 4mm YELLOW', 'LUG 50 MM ( FOR EARTHING RTU )'
                ]
            } else if (event.value === "PVC CONDUIT ACCESSORIES(ORANGE)") {
                typeValue = ['SADDLE CLIP ORANGE PVC 25 MM', 'FEMALE ADAPTOR / BUSH ORANGE PVC 25 MM',
                    'SOCKET ORANGE PVC 25 MM', 'LONG BEND ORANGE PVC 25 MM',
                    'INSPECTION TEE ORANGE 25 MM', 'PIPE CONDUIT ORANGE 25 MM',
                    'FLEXIBLE CONDUIT ORANGE 1" (50M/PER-COILS)(1 roll = 5-6 sites) 25 mm',
                    'WIRING DUCT GREY', 'PVC ENCLOSURE BOX ( JUNCTION BOX ) WIREMAN BOX 643'
                ];
            } else if (event.value === "CABLE GLAND") {
                typeValue = ['METAL CABLE GLAND 204/206 (PIW)', 'METAL CABLE GLAND 204/206 (RTU)',
                    'METAL CABEL GLAND 256 (RTU)', 'METAL CABEL GLAND 326 (RTU)',
                    'PLASTIC GLAND SIZE 13.5 (WHITE)', 'PLASTIC GLAND SIZE 11 (WHITE)',
                    'PLASTIC GLAND SIZE 9 (WHITE)', 'PLASTIC GLAND SIZE 7 (WHITE)',
                    'EARTH TAG 20 (3/4")',
                    'EARTH TAG 25 (1")', 'EARTH TAG 32 (RTU)'
                ];
            } else if (event.value === "PVC ADHESIVE TAPE") {
                typeValue = ['BLACK (BUNDLE)', 'COLOR (BUNDLE)', 'MASKING TAPE (ROLL)'];
            } else if (event.value === "MARKING TUBING") {
                typeValue = ['MARKING TUBE PUTIH (2.5MM)(RTU)', 'MARKING TUBE PUTIH (3.2MM)',
                    'MARKING TUBE PUTIH (3.6MM)/PER METER 10 -20 SITES (BC USE)',
                    'MARKING TUBE PUTIH (3.6MM)/PER METER 10 -20 SITES (RTU USE)',
                    'MARKING TUBE PUTIH (4.2MM)',
                    'MARKING TUBE KUNING (6MM) (per meter) 20-30 SITES CABLE TAGGING PIW',
                    'MARKING TUBE KUNING (6MM) (per meter) 20-30 SITES CABLE TAGGING RTU',
                    'INK RIBBON HITAM (Max LM - 550 A Electronics)', 'MARKER STRIP PER PAX'
                ];
            } else if (event.value === "SWITCH & SOCKET") {
                typeValue = ['PLUGTOP UMS (PT130 R) 13 A (JB ONLY)',
                    'CLIPSAL E15 FLUSH SW/SKT 13 A (JB ONLY)', 'PVC WHITE BASE 3 X 3 (JB ONLY)',
                    'PVC WHITE BASE small'
                ];
            } else if (event.value === "CABLE TRAY") {
                typeValue = ['2" GI CABLE TRAY (G18)', '4" GI CABLE TRAY (G18)',
                    '6" GI CABLE TRAY (G18) (4 CB)', '6" GI CABLE TRAY (G18) (RTU)',
                    '8" GI CABLE TRAY (G18) (4 CB)', '12" GI CABLE TRAY (G18) (8 CB)'
                ];
            } else if (event.value === "CABLE TIE") {
                typeValue = ['CABLE TIE 4INCI', 'CABLE TIE 6INCI (PIW)', 'CABLE TIE 6INCI (RTU)',
                    'CABLE TIE 12INCI (PIW)', 'CABLE TIE 12INCI (RTU)'
                ];
            } else if (event.value === "CABLE TRAY SUPPORT") {
                typeValue = ["SUPPORT L 2' (PIW)", "SUPPORT L (short) (RTU)", "SUPPORT C",
                    "SUPPORT GANTUNG (short)", "SUPPORT GANTUNG (medium)"
                ];
            } else if (event.value === "FERRULE MARKERS(PARTEX WHITE)") {
                typeValue = ['BLUE APPLICATOR (LIDI)', 'A', 'B', 'C', 'D', 'E', 'F', 'I', 'J', 'K', 'L',
                    'M', 'N', 'P', 'R', 'S', 'T', 'U', 'V', 'X', '-', '0', '1', '2', '3', '4', '5',
                    '6', '7', '8', '9'
                ]
            } else if (event.value === "FERRULE MARKERS(PARTEX YELLOW)") {
                typeValue = ['X', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
            } else if (event.value === 'FERRULE MARKERS(PARTEX RED)') {
                typeValue = ['TRIP'];
            } else if (event.value === 'FASTENER') {
                typeValue = ['DROP IN ANCHORS (Z/P) 1/2 X 40 X 12 OD (GANTUNG CORING)',
                    'DROP IN ANCHORS BSW (Z/P) 5/16 X 30 X 10 OD (GANTUNG TRAY)',
                    'DRYWALL SCREW (B/O) #6 X 2" (BOX)', 'DRYWALL SCREW (B/O) #6 X 2 1/2 " (RTU)',
                    'DRYWALL SCREW (B/O) #6 X 3 "', 'PVC WALL PLUG M6X30',
                    'FLAT WASHER OD BIG (Z/P) 5/16 X 22 X 1.5 (Gantung Tray)',
                    'MS HEX NUTS BSW (Z/P) 5/16"',
                    'MS STUD BOLTS BSW (Z/P) 1/2" X 6 FEET (GANTUNG CORING)',
                    'MS STUD BOLTS BSW (Z/P) 5/16 X 6 FEET (GANTUNG TRAY)',
                    'SELF DRILLING SCREWS (Z/P) #8 X 1/2 (M4 X 13) (PER BOX)',
                    'PJ ANCHORS (R/P) 5/16 X 2 3/4 X 10 OD (GANTUNG SUPPORT,RTU&RCB)',
                    'ROUND HD (+-) M/C SCREW / NUTS (Z/P) 1/4 X 5/8 (SCREW TRAY)',
                    'GALVANISE WIRE ROPE CLIP'
                ];
            } else if (event.value === 'WEAR & TEARS TOOLS') {
                typeValue = ['HOLE SAW 25mm (IRON)', 'HOLE SAW 20mm (IRON)',
                    'DRILL BIT 5.5mm (CONCRETE)', 'DRILL BIT 6mm (CONCRETE)',
                    'DRILL BIT 8mm (CONCRETE) (for fragile wall)', 'DRILL BIT 10mm (CONCRETE)',
                    'DRIL BIT 12mm (CONCRETE)', 'DRIL BIT 25mm (CONCRETE)',
                    'DRILL BIT 10MM (STEEL) (makes hole for brackets)', 'GRINDER DISC CUTTER 4"',
                    'GRINDER DISC CUTTER 14"', 'DAIMOND CORING BIT 5"', 'SCREWDRIVER DRILL BIT',
                    'WELDING ARC ROD PW 6013 (2.6MM) / KG',
                    'MIG GAS', 'MIG ELECTRODE SPOOL', 'BITUMEN', 'CHUCK KEY',
                    '3 LITER SILVER PAINT ( USED FOR SUPPORT )',
                    'SCI PLASTER WHITE 25 KG P12 ( WHITE CEMENT FOR TOC USED )', 'MARKER PEN',
                    'SAFETY BARRICADE TAPE', 'FRAGILE BARRICADE TAPE', 'RUBBER STAMP',
                    'THINNER ( LITER )', 'SAFETY VEST', 'SAFETY GLOVE', 'AIR BATTERY', 'MASK',
                    'LUBRICANTS'
                ];
            }


            console.log($(event).parent().next().children());
            $(event).parent().next().children().append(`<option value="" hidden>select type</option>`)


            typeValue.map((opt) => {
                $(event).parent().next().children().append(`<option value="${opt}">${opt}</option>`)
            })
        }


        function addRow() {

            var selectOptions = `<select name="item[]" class="form-control change required" id="item${orderCount}" onchange="selectItem(this)">
                            <option hidden value="">Select item</option>
                            <option value="CABLE FOR PIW VCB">CABLE FOR PIW VCB</option>
                            <option value="CABLE FOR RTU / VCB">CABLE FOR RTU / VCB</option>
                            <option value="TRANSDUCER">TRANSDUCER</option>
                            <option value="MCB">MCB</option>
                            <option value="SELECTOR SWITCH">SELECTOR SWITCH</option>
                            <option value="EFI BASE PLATE">EFI BASE PLATE</option>
                            <option value="TERMINAL BLOCKS">TERMINAL BLOCKS</option>
                            <option value="CABLE UG">CABLE UG</option>
                            <option value="PVC CONDUIT ACCESSORIES(ORANGE)">PVC CONDUIT ACCESSORIES(ORANGE)</option>
                            <option value="CABLE GLAND">CABLE GLAND</option>
                            <option value="PVC ADHESIVE TAPE">PVC ADHESIVE TAPE</option>
                            <option value="MARKING TUBING">MARKING TUBING</option>
                            <option value="SWITCH & SOCKET">SWITCH & SOCKET</option>
                            <option value="CABLE TRAY">CABLE TRAY</option>
                            <option value="CABLE TIE">CABLE TIE</option>
                            <option value="CABLE TRAY SUPPORT">CABLE TRAY SUPPORT</option>
                            <option value="FERRULE MARKERS(PARTEX WHITE)">FERRULE MARKERS(PARTEX WHITE)</option>
                            <option value="FERRULE MARKERS(PARTEX YELLOW)">FERRULE MARKERS(PARTEX YELLOW)</option>
                            <option value="FERRULE MARKERS(PARTEX RED)">FERRULE MARKERS(PARTEX RED)</option>
                            <option value="FASTENER">FASTENER</option>
                            <option value="WEAR & TEARS TOOLS">WEAR & TEARS TOOLS</option>
                           
                        </select>`;

            $('#order-table').append(`
            <tr>
                <td class="text-center"><strong>${orderCount}</strong></td>
                <td> ${selectOptions}</td>
                <td><select name='type[]' id='type${orderCount}' class='form-control required'><option hidden value=''>select type</option></select></td>
                <td><input type="number" name="unit[]" id="unit${orderCount}" class='form-control required'></td>
                <td><button class="btn btn-danger " onclick="remove(this)">remove<button></td>
                </tr>
            `)
            orderCount++;
        }

        function remove(event) {
            $(event).closest('tr').remove();
        }

        function submitFoam() {

var class_error = document.querySelectorAll('.required');
if(class_error.length < 1){
    return false
}


var id = '';


var isValid = true;

for (var i = 0; i < class_error.length; i++) {
    console.log(class_error);
    var id = class_error[i].id;
    if ($(`#${id}`).val() === '' && id != "other") {
        if ($(`#${id}`).parent().find('span').length < 1) {
            $(`#${id}`).parent().prepend('<span class="text-danger">This field is required</span>');

        }
        isValid = false
    } else {
        if ($(`#${id}`).parent().find('span').length > 0) {
            $(`#${id}`).parent().find('span').remove().end();
        }
    }
}




if (isValid) {
    const overlay = document.getElementById('overlay');
    overlay.style.display = 'block';
}
return isValid;

}
    </script>
    
@endsection
