<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReferenceLinks\ReferenceLinkRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ReferenceLink;
use App\User;

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
        $referLink = new ReferenceLink($request->input());
        $referLink->reference_link = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 16);
        $referLink->save();

        return redirect()->back();
    }
}
