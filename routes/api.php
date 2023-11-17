<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController; 
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Mengurung dengan middleware
Route::middleware(['auth'])->group(function () {

//Route Mendapatkan Seluruh Data Employees
Route::get('/employees', [EmployeeController::class, 'index']);

//Route Menambahkan Data Employees
Route::post('/employees', [EmployeeController::class, 'store']);

//Route Melihat Detail Data Employees
Route::get('/employees/{id}', [EmployeeController::class, 'show']);

//Route Mengubah Data Employees
Route::put('/employees/{id}', [EmployeeController::class, 'update']);

//Route Menghapus Data Employees
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);

//Route Mencari Data Employees berdasarkan Nama
Route::get('/employees/search/{name}', [EmployeeController::class, 'search']);

//Route Mengaftikan Data Employees
Route::get('employees/status/active', [EmployeeController::class, 'active']);

//Route inaktifkan Data Employees
Route::get('employees/status/inactive', [EmployeeController::class, 'inactive']);

//Route terminate Data Employees
Route::get('employees/status/terminated', [EmployeeController::class, 'terminated']);

//Route Membuat register dan login
Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

});