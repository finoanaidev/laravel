<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function getMethod(){
        return response()->json(['succes' => 'Methode GET']);
    }

    public function postMethod(Request $request) {
        return $request->all();
    }
}
