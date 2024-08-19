<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\employeeController;
use App\Http\Controllers\Api\assistenceController;

//FUCTION GET ALL EMPLOYEES

Route::get('/employees', [employeeController::class, 'index']);

//FUCTION FOR GET EMPLOYEES WITH ID

Route::get('/employees/{employee_id}', [employeeController::class, 'show']);

//FUCTION GET ALL ASSISTENCES

Route::get('/assistence', [assistenceController::class, 'index']);

//FUCTION FOR GET ASSITENCE WITH ID

Route::get('/assistence/{employee_id}', [assistenceController::class, 'show']);

//FUCTION - POST ASISTENCE 

Route::post('/assistence', [assistenceController::class, 'store']);

//FUCTION USE IN ASISTENTE MODULE`S

//UPDATE FOR DATE
Route::put('/assistence/{employee_id}/{date}', [assistenceController::class, 'update']);

//FUCTIONS USED IN RECORDS

//GET HOURS FOR MOUNTH
Route::get('assistence/work-hours/{year}/{employee_id}', [assistenceController::class, 'getWorkHoursByMonth']);

//GET HOURS FOR YEAR
Route::get('assistence/annual-hours/{employee_id}/{anio}', [assistenceController::class, 'getAnnualHoursByEmployee']);

//GET HOURS FOR WEEK
Route::get('assistence/weekly-hours/{employee_id}/{anio}/{mes}', [assistenceController::class, 'getWeeklyHoursByMonth']);

//GET DETAILS FOR DAY
Route::get('assistence/daily-details/{employee_id}/{anio}/{mes}/{semana}', [assistenceController::class, 'getDailyDetailsByWeek']);



