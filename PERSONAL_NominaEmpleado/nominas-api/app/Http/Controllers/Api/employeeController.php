<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\FuncCall;

use function PHPUnit\Framework\isEmpty;

class employeeController extends Controller
{
    public function index(){
        $employees= DB::select('select employee_id, firstname, lastname, address, birthdate, usu_correo, gender, position_id, schedule_id, photo from employees');

        if(!$employees){
            return response()->json(['message'=>'No hay empleados registrados'],200);
        }
        return response()->json($employees,200);
    }

    //Funcion para buscar un empleado por su id

    public function show($employee_id){
        $employee=DB::select('select e.id, e.employee_id,e.firstname,e.lastname, e.usu_correo,e.gender,e.photo, p.description FROM `employees` as `e` INNER JOIN `position` as `p` ON e.position_id = p.id  where employee_id = ?', [$employee_id]);

        if(!$employee){
            $data=[
                'message'=> 'Empleado no encontrado',
                'status'=> 404
            ];
            return response()->json($data,404);
        }

        $data=[
            'message'=> 'Empleado encontrado',
            'empleado'=> $employee,
            'status'=> 200
        ];

        return response()->json($data,200);

    }
}
