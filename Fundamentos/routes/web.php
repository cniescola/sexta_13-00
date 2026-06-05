<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loja;

//Route::get('/', function () {
   // return view('index');
//});

Route::get('/loja',[loja::class,'index'])->name('loja');

Route::get('/index',[loja::class,'loja'])->name('index');

Route::get('/lojavirtual',[loja::class,'amazon'])->name('amazon');

Route::get('/',[loja::class,'login'])->name('login');

Route::get('/login',[loja::class,'sign'])->name('sign');



//Route::get('/welcome', function () {
   // return view('welcome');
//})->name('welcome');



