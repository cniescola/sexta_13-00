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

     public function amazon(){
        return view('amazon');
    }

    public function login(){
        return view('login');
    }

    public function sign(){
        return view('sign');
    }

}
