<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReferenceLinks\ReferenceLinkRequest;
use App\Http\Controllers\Controller;
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

        $referenceId = (new \App\ReferenceLink)->getLink($referenceCode)->first()->id;
        
        $claimHistory = ClaimHistory::create([
            'customer_id' => $customer->id,
            'reference_link_id' => $referenceId,
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
