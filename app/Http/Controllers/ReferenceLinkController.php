<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReferenceLinks\ReferenceLinkRequest;
use App\Http\Controllers\Controller;
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
        $referLink->reference_link = $referCode;
        $referLink->reference_code = $referCode;
        $referLink->save();

        return redirect()->back();
    }

    public function linkFetcher(Request $request, $referenceCode)
    {
        $customer = Customer::create($request->all());

        // $referenceData = (new \App\ReferenceLink)->getLink($referenceCode)->first();
        $referenceData = DB::table('reference_links')->where('reference_code', $referenceCode)
            ->first();

        $point_to_add = $referenceData->point;

        $pointData = (new \App\Point)->getAgent($referenceData->agent_id)->first();
        // dd($pointData);
        $pointData->total_point += $point_to_add;
        $pointData->point_claimed += $point_to_add;
        $pointData->save();
        
        $claimHistory = ClaimHistory::create([
            'customer_id' => $customer->id,
            'reference_link_id' => $referenceData->id,
        ]);
        
    }

    public function viewFetcher($referenceCode)
    {
        $found = (new \App\ReferenceLink)->getLink($referenceCode)->first();

        if($found->count() > 0)
        {
            return view('reference_link.viewFetcher', compact('found'));
        }

        return redirect()->back();
    }
}
