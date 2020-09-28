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
        			->with('point')
        			->get();

        return view('agents.index', compact('agents'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'password_confirmation' => 'required'
        ]);

        $agent = Agent::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 15
        ]);

        Point::create([
            'user_id' => $agent->id,
        ]);

        return redirect()->route('admin.page.agent')->with('success', 'New agent created!');
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
