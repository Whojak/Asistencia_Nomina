<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assistence extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table='assistence';

    protected $fillable=[
        'employee_id',
        'time_entry',
        'time_exit',
        'work_completed',
        'time_to_recover',
        'break_completed',
        'additional_time',
        'dealy_breaks',
        'lunch_time',
        'justificacion',
        'token',
        'date'
    ];
}
