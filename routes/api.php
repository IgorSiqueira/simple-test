<?php

use App\Http\Controllers\CovenantController;
use App\Http\Controllers\DebitController;
use Illuminate\Support\Facades\Route;

Route::get('',function(){return response()->json(['success'=>true]);});
Route::post('debit/paid',[DebitController::class, 'webHookPaid']);
Route::apiResource('covenants',CovenantController::class,[
    'only'=>['index','store']
]);



