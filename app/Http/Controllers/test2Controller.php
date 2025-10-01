<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\addedmodel;

class test2Controller extends Controller
{
    public function index()
    {
        return view('testview');
    }
}
