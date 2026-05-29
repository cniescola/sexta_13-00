<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loja;

//Route::get('/', function () {
   // return view('index');
//});

Route::get('/loja',[loja::class,'index'])->name('loja');

Route::get('/index',[loja::class,'loja'])->name('index');



//Route::get('/welcome', function () {
   // return view('welcome');
//})->name('welcome');



