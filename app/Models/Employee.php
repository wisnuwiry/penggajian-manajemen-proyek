<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'birth_date',
        'hire_date',
        'nik',
        'department_id',
        'position_id',
        'email',
        'phone_number',
        'address',
        'salary',
        'bank_name',
        'bank_account_number',
    ];

    public function getFormattedIdAttribute()
    {
        return 'EM' . str_pad($this->attributes['id'], 4, '0', STR_PAD_LEFT);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }

    protected function casts(): array
    {
        return [
            'birth_date' => 'datetime',
            'hide_date' => 'datetime',
        ];
    }
}
