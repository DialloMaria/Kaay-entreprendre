<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRessourceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'lien' => 'required|url',
            'type' => 'required|string',
            'guide_id' => 'required|exists:guides,id',
            'created_by' => 'required|exists:users,id',
            'modified_by' => 'nullable|exists:users,id',
        
              ];




    }
}
