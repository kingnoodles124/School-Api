<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\StudentController;

use function Pest\Laravel\post;

Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

Route::post('/admin/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('students', StudentController::class);
    Route::apiResource('classes', ClassController::class);

    Route::post('/classes/{class}/assign/{student}', 
        [ClassController::class, 'assignStudent']
    );
});



// Route::post('/student/create', [AuthController::class, 'login']);