<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Assistence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;


class assistenceController extends Controller
{
    //Funcion para obtener toda la lista de asistencia
    public function index(){
        $assistence= Assistence::all();

        if($assistence->isEmpty()){
            return response()->json(['message'=>'No hay empleados registrados'],200);
        }
        return response()->json($assistence,200);
    }

    //Funcion para obtener asistencia de un empleado por su id
    public function show($employee_id){
        $assistence=DB::select('select e.employee_id, a.time_entry,a.time_exit, a.work_completed, a.time_to_recover, a.break_completed, a.additional_time, a.dealy_breaks, a.lunch_time, a.justificacion,a.token, a.date FROM `assistence` as `a` INNER JOIN `employees` as `e` ON a.employee_id = e.id WHERE e.employee_id=?;', [$employee_id]);

        if(!$assistence){
            $data=[
                'message'=> 'Asistencia de empleado no encontrada',
                'status'=> 404
            ];
            return response()->json($data,404);
        }

        $data=[
            'assistencia'=> $assistence,
            'status'=> 200
        ];

        return response()->json($data,200);

    }

    //Funcion para almacenar un registro nuevo de asistencia
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'employee_id' => 'required|exists:employees,id',
            'time_entry' => 'required',
            'time_exit' => '',
            'work_completed' => '',
            'time_to_recover' => '',
            'break_completed' => '',
            'additional_time' => '',
            'dealy_breaks' => '',
            'lunch_time' => '',
            'justificacion' => '',
            'token' => '',
            'date' => 'required'
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Error al validar los datos',
                'errores' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400); // Cambié a 400 porque es un error del cliente
        }

        try {
            $assistence = Assistence::create([
                'employee_id' => $request->employee_id,
                'time_entry' => $request->time_entry,
                'time_exit' => $request->time_exit,
                'work_completed' => $request->work_completed,
                'time_to_recover' => $request->time_to_recover,
                'break_completed' => $request->break_completed,
                'additional_time' => $request->additional_time,
                'dealy_breaks' => $request->dealy_breaks,
                'lunch_time' => $request->lunch_time,
                'justificacion' => $request->justificacion,
                'token' => $request->token,
                'date' => $request->date
            ]);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error al registrar nueva asistencia', 'error' => $e->getMessage(), 'status' => 500], 500);
        }

        $data = [
            'message' => 'Se ha registrado una nueva asistencia',
            'assistence' => $assistence,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    //METODO PARA ACTUALIZAR

    public function update(Request $request, $employee_id, $date)
    {
        $validator = Validator::make($request->all(), [
            'time_entry' => '',
            'time_exit' => '',
            'work_completed' => '',
            'time_to_recover' => '',
            'break_completed' => '',
            'additional_time' => '',
            'dealy_breaks' => '',
            'lunch_time' => '',
            'justificacion' => '',
            'token' => ''
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error al validar los datos',
                'errores' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        try {
            $assistence = Assistence::where('employee_id', $employee_id)
                ->where('date', $date)
                ->firstOrFail();

            $assistence->update([
                'time_entry' => $request->time_entry,
                'time_exit' => $request->time_exit,
                'work_completed' => $request->work_completed,
                'time_to_recover' => $request->time_to_recover,
                'break_completed' => $request->break_completed,
                'additional_time' => $request->additional_time,
                'dealy_breaks' => $request->dealy_breaks,
                'lunch_time' => $request->lunch_time,
                'justificacion' => $request->justificacion,
                'token' => $request->token                
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Error al actualizar la asistencia',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }

        return response()->json([
            'message' => 'Asistencia actualizada correctamente',
            'assistence' => $assistence,
            'status' => 200
        ], 200);
    }



//OBTENER POR MES



    public function getWorkHoursByMonth(Request $request, $year, $employee_id)
{
    // Validar que el año sea un número y que exista el ID del empleado
    $validator = Validator::make(
        ['year' => $year, 'employee_id' => $employee_id],
        [
            'year' => 'required|numeric|min:1900|max:' . date('Y'),
            'employee_id' => 'required|exists:employees,id'
        ]
    );

    if ($validator->fails()) {
        return response()->json([
            'message' => 'Error al validar los datos',
            'errores' => $validator->errors(),
            'status' => 400
        ], 400);
    }

    // Realizar la consulta SQL
    $workHours = DB::select(
        'SELECT MONTH(date) AS mes, SUM(work_completed) AS total_horas 
        FROM assistence 
        WHERE YEAR(date) = :year 
        AND employee_id = :employee_id 
        GROUP BY mes 
        ORDER BY mes;',
        ['year' => $year, 'employee_id' => $employee_id]
    );

    // Verificar si la consulta devolvió resultados
    if (empty($workHours)) {
        return response()->json([
            'message' => 'No se encontraron registros para el año seleccionado',
            'status' => 404
        ], 404);
    }

    return response()->json([
        'year' => $year,
        'employee_id' => $employee_id,
        'work_hours' => $workHours,
        'status' => 200
    ], 200);
}



//OBTENER HORA ANUAL

public function getAnnualHoursByEmployee($employee_id, $anio) {
    try {
        $result = DB::select('
            SELECT 
                YEAR(date) AS anio,
                SUM(work_completed) AS total_horas_anuales
            FROM assistence
            WHERE YEAR(date) = ?
              AND employee_id = ?
            GROUP BY anio
            ORDER BY anio;
        ', [$anio, $employee_id]);

        if (empty($result)) {
            return response()->json([
                'message' => 'No se encontraron registros para el año especificado',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'anio' => $result[0]->anio,
            'total_horas_anuales' => $result[0]->total_horas_anuales,
            'status' => 200
        ], 200);
    } catch (QueryException $e) {
        return response()->json([
            'message' => 'Error al obtener las horas anuales',
            'error' => $e->getMessage(),
            'status' => 500
        ], 500);
    }
}


//OBTENER HORAS POR SEMANA

public function getWeeklyHoursByMonth($employee_id, $anio, $mes) {
    try {
        $result = DB::select('
            SELECT 
                employee_id,
                YEAR(date) AS anio,
                MONTH(date) AS mes,
                FLOOR((DAY(date) - 1) / 7) + 1 AS semana_del_mes,
                SUM(work_completed) AS total_horas
            FROM assistence
            WHERE YEAR(date) = ?
              AND MONTH(date) = ?
              AND employee_id = ?
            GROUP BY employee_id, anio, mes, semana_del_mes
            ORDER BY anio, mes, semana_del_mes;
        ', [$anio, $mes, $employee_id]);

        if (empty($result)) {
            return response()->json([
                'message' => 'No se encontraron registros para el año y mes especificados',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'employee_id' => $employee_id,
            'anio' => $anio,
            'mes' => $mes,
            'semanas' => $result,
            'status' => 200
        ], 200);
    } catch (QueryException $e) {
        return response()->json([
            'message' => 'Error al obtener las horas semanales por mes',
            'error' => $e->getMessage(),
            'status' => 500
        ], 500);
    }
}



//OBTENER DETALLES POR DIA

public function getDailyDetailsByWeek($employee_id, $anio, $mes, $semana) {
    try {
        $result = DB::select('
            SELECT 
                *
            FROM assistence
            WHERE YEAR(date) = ?
              AND MONTH(date) = ?
              AND employee_id = ?
              AND FLOOR((DAY(date) - 1) / 7) + 1 = ?
            ORDER BY date
            LIMIT 0, 25;
        ', [$anio, $mes, $employee_id, $semana]);

        if (empty($result)) {
            return response()->json([
                'message' => 'No se encontraron registros para el año, mes y semana especificados',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'employee_id' => $employee_id,
            'anio' => $anio,
            'mes' => $mes,
            'semana' => $semana,
            'details' => $result,
            'status' => 200
        ], 200);
    } catch (QueryException $e) {
        return response()->json([
            'message' => 'Error al obtener los detalles diarios por semana',
            'error' => $e->getMessage(),
            'status' => 500
        ], 500);
    }
}



}
