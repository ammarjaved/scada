<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsuBudgetTNBModel extends Model
{
    use HasFactory;
    protected $table = "csu_budget_tnb";

    protected $fillable = [
        'pe_name',
        'kkb',
        'cfs',
        'scada',
        'total',
        'date_time',
       
    ];

}
