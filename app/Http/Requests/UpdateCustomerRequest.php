<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class UpdateCustomerRequest extends FormRequest
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
        return  [
            'name'=>'required|max:45',
            'last_name'=>'required|max:45',
            'birthday'=>'required|date',
            'dni'=>['required','digits:13', Rule::unique('customers')->ignore($this->customer->id)],
            'email'=>['nullable','email:rfc',Rule::unique('customers')->ignore($this->customer->id)],
            'cellphone_number'=>['required','digits:8',Rule::unique('customers')->ignore($this->customer->id)],
            'address'=>'required|max:100'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.max' => 'El nombre no debe contener más de 45 caracteres.',
            'last_name.required' => 'El apellido es obligatorio.',
            'last_name.max' => 'El apellido no debe contener más de 45 caracteres.',
            'dni.required' => 'El número de identidad es obligatorio.',
            'dni.unique' => 'Éste número de identidad ya está registrado.',
            'dni.digits' => 'El número de identidad debe contener 13 digitos sin espacios ni guiones.',
            'birthday.required' => 'La fecha de nacimiento es obligatoria.',
            'birthday.date' => 'Este campo debe ser insertado en formato de fecha.',
            'cellphone_number.required' => 'El número celular es obligatorio.',
            'cellphone_number.unique' => 'Éste número celular ya está registrado.',
            'cellphone_number.digits' => 'El número celular debe contener 8 dígitos sin espacios ni guiones.',
            'address.required' => 'La dirección es obligatoria.',
            'address.max' => 'La dirección no debe exceder los 100 caracteres.',
            'email.required' => 'El email es obligatorio.',
            'email.unique' => 'Éste email ya está registrado.',
        ];
    }
}
