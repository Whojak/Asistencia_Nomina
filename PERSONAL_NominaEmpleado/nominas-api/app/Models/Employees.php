<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table='employees';

    protected $fillable=[
        'employee_id',
        'firstname',
        'lastname',
        'address',
        'birthdate',
        'usu_correo',
        'gender'
    ];
}
