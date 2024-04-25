<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index(){
        $data = ['server' => 'ready'];
        return response()->json($data);
    }
    public function no_access(){
        abort(403, 'Akses tidak sah!');
    }
}
