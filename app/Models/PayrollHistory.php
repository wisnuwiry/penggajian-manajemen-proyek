<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'payroll_id', 'status', 'remarks'
    ];

    public function payroll()
    {
        return $this->belongsTo(Payroll::class);
    }
}
