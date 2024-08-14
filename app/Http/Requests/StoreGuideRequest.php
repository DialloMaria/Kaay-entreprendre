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
            'etape' => 'required|integer',
            'media' => 'required|string',
            'domaine_id' => 'required|exists:domaines,id',
            'created_by' => 'required|exists:users,id',
            'modified_by' => 'nullable|exists:users,id',
        ];
    }
}
