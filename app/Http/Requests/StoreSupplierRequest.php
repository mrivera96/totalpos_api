<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSupplierRequest extends FormRequest
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
            'name' => 'required|max:100',
            'description' => 'required',
            'phone_number' => ['required', 'digits:8', 'unique:suppliers'],
            'address' => 'required',
            'email' => ['required','max:100', 'email:rfc','unique:suppliers']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.max' => 'El nombre no debe exceder los 100 caracteres.',
            'description.required' => 'La descripción es obligatoria.',
            'phone_number.required' => 'El número de teléfono es obligatorio.',
            'phone_number.unique' => 'Éste número de teléfono ya está registrado.',
            'phone_number.digits' => 'El número de teléfono debe contener 8 dígitos sin espacios ni guiones.',
            'address.required' => 'La dirección es obligatoria.',
            'email.required' => 'El email es obligatorio.',
            'email.unique' => 'Éste email ya está registrado.',
            'email.email' => 'El email ingresado no es válido.',
            'email.max' => 'El email no debe exceder los 100 caracteres.'
        ];
    }
}
