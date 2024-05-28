<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'payroll_date'
    ];

    public function getFormattedIdAttribute()
    {
        return 'PY' . str_pad($this->attributes['id'], 4, '0', STR_PAD_LEFT);
    }

    public function details()
    {
        return $this->hasMany(PayrollDetail::class);
    }

    public function getTotalTakeHomePayAttribute()
    {
        return $this->details->sum(function ($detail) {
            return $detail->take_home_pay;
        });
    }

}
