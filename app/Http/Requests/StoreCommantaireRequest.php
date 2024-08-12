<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentaireRequest extends FormRequest
{
    public function authorize()
    {

        return true;
    }

    public function rules()
    {
        return [
            'contenu' => 'required|string',
            'evenement_id' => 'required|exists:evenements,id',
        ];
    }
}
