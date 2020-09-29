<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReferenceLinks\ReferenceLinkRequest;
use App\Http\Controllers\Controller;
use App\Point;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\ReferenceLink;
use App\User;
use App\ClaimHistory;
use App\Customer;

class ReferenceLinkController extends Controller
{
    public function index()
    {
        $agents = User::agent()->get();
        $referenceLinks = ReferenceLink::all();
        // dd($referenceLinks);

        return view('reference_link.index', compact('agents','referenceLinks'));
    }

    public function store(ReferenceLinkRequest $request)
    {
        $referCode = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 16);
        $referLink = new ReferenceLink($request->input());
        $referLink->reference_link = url('/refer').'/'.$referCode;
        $referLink->reference_code = $referCode;
        $referLink->save();

        return redirect()->back();
    }

    public function linkFetcher(Request $request, $referenceCode)
    {
        $customer = Customer::create($request->all());

        $referenceData = ReferenceLink::where('reference_code', $referenceCode)
            ->first();

        $point_to_add = $referenceData->point;

        $pointData = Point::firstOrCreate([
            'user_id' => $referenceData->agent_id,
            ], [
                'user_id' => $referenceData->agent_id,
        ]);

        $pointData->total_point += $point_to_add;
        $pointData->point_claimed += $point_to_add;
        $pointData->save();
        
        $claimHistory = ClaimHistory::create([
            'customer_id' => $customer->id,
            'reference_link_id' => $referenceData->id,
        ]);

        //should return chat message page here
        
    }

    public function viewFetcher($referenceCode)
    {
        $found = (new \App\ReferenceLink)->getLink($referenceCode)->first();

        if(!blank($found))
        {
            return view('reference_link.viewFetcher', compact('found'));
        }

        return redirect()->back()->with('error', 'No link found!');
    }
}
