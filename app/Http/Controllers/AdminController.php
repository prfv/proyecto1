<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{ //segunda forma con el metodo constructor

    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        return view('admin.index');
    }
    public function post(){
        return view('admin.post');
    }
}
