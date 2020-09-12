<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class ReferenceLinkController extends Controller
{
    public function index()
    {
        $agents = User::agent()->get();
        return view('reference_link.index', compact('agents'));
    }
}
