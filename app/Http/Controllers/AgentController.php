<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as Agent;

class AgentController extends Controller
{
    public function index()
    {
        $agents = Agent::agent()
        			->leftJoin('points', 'users.id', '=', 'points.user_id')
        			->get();

        return view('agents.index', compact('agents'));
    }
}
