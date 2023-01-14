<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class {{ controller }} extends Controller
{
    public function index()
    {
        return view('{{ view_main }}'); // {{ view_main }}
    }
}
