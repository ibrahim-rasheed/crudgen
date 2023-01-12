<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class {{ controller }} extends Controller
{
    public function index()
    {
        return view('livewire.{{ view_table_path }}');
    }
}
