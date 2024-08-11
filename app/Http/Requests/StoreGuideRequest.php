<?php


namespace App\Http\Requests;

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
            'media' => 'required|string',
            'auteur' => 'required|string',
            'domaine_id' => 'required|exists:domaines,id',
        ];
    }
}
