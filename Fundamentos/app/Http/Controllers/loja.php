<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class loja extends Controller
{

    public function index(){
        return view('lojavirtual');
    }

    public function loja(){
        return view('index');
    }

}
