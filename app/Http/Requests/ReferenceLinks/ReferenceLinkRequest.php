<?php

namespace App\Http\Requests\ReferenceLinks;

use Illuminate\Foundation\Http\FormRequest;

class ReferenceLinkRequest extends FormRequest
{
    public function rules()
    {
        return [
            'agent_id' => 'required',
            'point' => 'required|integer',
            'max_claim' => 'required|integer',
        ];
    }
}