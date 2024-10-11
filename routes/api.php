<?php

use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\InvoiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::apiResource("customer", CustomerController::class);
    Route::apiResource("invoice", InvoiceController::class);
    Route::post("invoice/bulk", [InvoiceController::class,"bulkStore"]);
}
);
