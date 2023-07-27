<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteDataCollection extends Model
{
    use HasFactory;

    protected $fillable = ['nama_pe', 'sub_station_type', 'switchgear', 'switchgear_2',  'switchgear_compact', 'type_feeder', 'switchgear_brand', 'switchgear_no', 'label_switch', 'type_cable', 'size_cable', 'tx_rating_1', 'tx_rating_2', 'tx_cable_1', 'tx_cable_2', 'genset_place', 'ct_cable', 'lvdb', 'type_lvdb', 'type_fuse', 'feeder', 'rating', 
    'full_switchgear', 'full_tx1', 'full_tx2', 'full_lvdb', 'kiri_pe',  'plate1', 'plate2', 'plate3', 'plate_lvdb', 'kanan_pe', 'sisi_kiri', 'sisi_cable_kanan1', 'sisi_cable_kanan2', 'full_feeder', 'pintu_pe', 'sisi_kanan', 'sisi_cable_kiri1', 'sisi_cable_kiri2', 'tagging', 'board_pe', 'bawah_nampak_cable', 'atas1', 'atas2', 'full_depan_pe', 'depan_pe'];
}
