<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as Agent;
use App\Point;

class AgentController extends Controller
{
    public function index()
    {
        $agents = Agent::agent()
        			->leftJoin('points', 'users.id', '=', 'points.user_id')
        			->get();

        return view('agents.index', compact('agents'));
    }

    public function getAgentPoints($id)
    {
    	$pointsData = Points::find($id);

    	return $pointsData;
    }

    public function deductPoints(Request $Request, $id)
    {
    	$pointsData = Points::find($id);

    	$pointsData->total_point -= $request->point_deduct;
    	$pointsData->update();
    }
}
