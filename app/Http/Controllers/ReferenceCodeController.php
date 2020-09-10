<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReferenceCodeController extends Controller
{
    public function index()
    {
        return view('reference_code.index');
    }
}
