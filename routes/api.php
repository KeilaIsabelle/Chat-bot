<?php

use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\TypeReqsController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/', function () {
    return response()->json([
        'message' => 'API Laravel iniciada!',
    ]);
});


Route::apiResource('users', UserController::class);
Route::apiResource('enrollments', EnrollmentController::class);
Route::apiResource('attachments', AttachmentController::class);
Route::apiResource('requests', RequestController::class);
Route::apiResource('typereqs', TypeReqsController::class);

