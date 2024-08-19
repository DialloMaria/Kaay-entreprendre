<?php


namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;


class StoreGuideRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Assurez-vous d'ajouter une logique d'autorisation si nécessaire
    }

    public function rules()
    {
        return [
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
            'datepublication' => 'required|date',

            // Validation unique de l'étape dans le sous-domaine spécifié
            'etape' => [
                'required',
                'integer',
                Rule::unique('guides')->where(function ($query) {
                    return $query->where('domaine_id', $this->domaine_id);
                }),
            ],

            'media' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'domaine_id' => 'required|exists:domaines,id',
            'modified_by' => 'nullable|exists:users,id',
        ];
    }
}
