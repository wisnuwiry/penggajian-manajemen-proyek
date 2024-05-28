<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_name',
        'description',
        'manager_id',
    ];

    public function getFormattedIdAttribute()
    {
        return 'DP' . str_pad($this->attributes['id'], 4, '0', STR_PAD_LEFT);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function manager()
    {
        return $this->belongsTo(Employee::class, 'manager_id');
    }
}
