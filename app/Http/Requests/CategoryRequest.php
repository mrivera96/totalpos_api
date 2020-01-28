<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'description'=>'required|max:45'
        ];
    }

    public function messages()
    {
        return [
            'description.required'=>'La descripción es obligatoria.',
            'description.max'=>'La descripción no debe exceder los 45 caracteres.'
        ];
    }
}
