<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VcbBudgetTNBModel extends Model
{
    use HasFactory;
    protected $table = "vcb_budget_tnb";

    protected $fillable = [
        'pe_name',
        'rtu_status',
        'cfs',
        'scada',
        'total',
        'date_time',
    ];

}
