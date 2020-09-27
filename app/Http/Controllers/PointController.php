<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Point;

class PointController extends Controller
{
    public function index()
    {
        return view('point.index');
    }

    public function deduct(Request $request, $id)
    {
        $point = Point::firstOrCreate([
            'user_id' => $id
        ], [
            'user_id' => $id
        ]);
        $point->total_point -= $request->point_to_deduct;
        $point->save();

        return redirect()->back()->with('success', 'Point has been deducted from agent account!');
    }
}
