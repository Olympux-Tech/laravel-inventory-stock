<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReferenceLinkController extends Controller
{
    public function index()
    {
        return view('reference_code.index');
    }
}
