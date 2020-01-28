<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
            'dni'=>'required|numeric|digits:13|unique:customers',
            'email'=>'nullable|email:rfc|unique:customers',
            'cellphone_number'=>'required|numeric|digits:8|unique:customers',
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
            'dni.numeric' => 'El número de identidad debe contener únicamente números.',
            'birthday.required' => 'La fecha de nacimiento es obligatoria.',
            'birthday.date' => 'Este campo debe ser insertado en formato de fecha.',
            'cellphone_number.required' => 'El número celular es obligatorio.',
            'cellphone_number.unique' => 'Éste número celular ya está registrado.',
            'cellphone_number.digits' => 'El número celular debe contener 8 dígitos sin espacios ni guiones.',
            'cellphone_number.numeric' => 'El número celular debe contener únicamente números.',
            'address.required' => 'La dirección es obligatoria.',
            'address.max' => 'La dirección no debe exceder los 45 caracteres.',
            'email.required' => 'El email es obligatorio.',
            'email.unique' => 'Éste email ya está registrado.',
        ];
    }
}
