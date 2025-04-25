<?php

use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\ConsultationController;
use App\Http\Controllers\Api\PetController;
use App\Http\Controllers\Api\ProcedureController;
use App\Http\Controllers\Api\VetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// obs nao sei se eh preciso o show
//clients
Route::get('/clients', [ClientController::class, 'index']);
Route::post('/clients', [ClientController::class, 'store']);
Route::get('/clients/{id}', [ClientController::class, 'show']);
Route::get('/clients/{id}/edit', [ClientController::class, 'edit']);
Route::put('/clients/{id}', [ClientController::class, 'update']);
Route::delete('/clients/{id}', [ClientController::class, 'destroy']);

//pet
Route::get('/pets', [PetController ::class, 'index']);
Route::post('/pets', [PetController::class, 'store']);
Route::get('/pets/{id}', [PetController::class, 'edit']);
Route::put('/pets/{id}', [PetController::class, 'update']);
Route::delete('/pets/{id}', [PetController::class, 'destroy']);

//vet
Route::get('/vets', [VetController ::class, 'index']);
Route::post('/vets', [VetController::class, 'store']);
Route::get('/vets/{id}', [VetController::class, 'edit']);
Route::put('/vets/{id}', [VetController::class, 'update']);
Route::delete('/vets/{id}', [VetController::class, 'destroy']);

//procedures

Route::get('/procedures', [ProcedureController ::class, 'index']);
Route::post('/procedures', [ProcedureController::class, 'store']);
Route::get('/procedures/{id}', [ProcedureController::class, 'edit']);
Route::put('/procedures/{id}', [ProcedureController::class, 'update']);
Route::delete('/procedures/{id}', [ProcedureController::class, 'destroy']);


//consultations

Route::get('/consultations', [ConsultationController ::class, 'index']);
Route::post('/consultations', [ConsultationController::class, 'store']);
Route::get('/consultations/{id}', [ConsultationController::class, 'show']);
Route::delete('/consultations/{id}', [ConsultationController::class, 'destroy']);