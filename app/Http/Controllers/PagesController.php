<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        return view('components.home');
    }

    public function un()
    {
        return view('components.etd_L1');
    }

    public function deux()
    {
        return view('components.etd_L2');
    }

    public function trois()
    {
        return view('components.etd_L3');
    }


}
