<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'position_name',
        'description',
    ];

    public function getFormattedIdAttribute()
    {
        return 'PS' . str_pad($this->attributes['id'], 4, '0', STR_PAD_LEFT);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
