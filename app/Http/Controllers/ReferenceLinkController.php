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

    public function linkFetcher($referenceCode)
    {
        $customer = Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'telepon' => $data['telepon'],
        ]);

        $referenceId = ReferenceLink::where('reference_code', $referenceCode)->first();
        
        $claimHistory = ClaimHistory::create([
            'customer_id' => $Customer->id,
            'reference_link_id' => $referenceId,
        ]);
        
    }

    public function viewFetcher($referenceCode)
    {
        $find = (new \App\ReferenceLink)->getLink($referenceCode)->count();

        if($find > 0)
        {
            return view('reference_link.viewFetcher');
        }

        return redirect()->back();
    }
}
