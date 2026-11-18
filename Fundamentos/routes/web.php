<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;

Route::get('/',[SiteController::class,'home'])->name('home');
Route::post('/',[SiteController::class,'store'])->name('enviar');