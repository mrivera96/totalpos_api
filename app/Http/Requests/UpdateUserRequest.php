<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|max:45',
            'last_name' => 'required|max:45',
            'avatar' =>'image|nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'username' => ['required','max:15', Rule::unique('users')->ignore($this->user->id)],
            'dni' => ['required','digits:13', Rule::unique('users')->ignore($this->user->id)],
            'birthday' => 'required|date',
            'mobile' => ['required','digits:8',  Rule::unique('users')->ignore($this->user->id)],
            'address' => 'required|max:100',
            'email' => ['required', 'max:100', 'email:rfc',Rule::unique('users')->ignore($this->user->id)]
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.max' => 'El nombre no debe exceder los 45 caracteres.',
            'last_name.required' => 'El apellido es obligatorio.',
            'last_name.max' => 'El apellido no debe exceder los 45 caracteres.',
            'avatar.image' =>'El avatar debe ser una imagen.',
            'avatar.mimes' =>'El avatar debe ser de alguno de estos formatos: jpeg,png,jpg,gif,svg.',
            'avatar.max' =>'El avatar no debe pesar más de 2048 MB.',
            'username.required' => 'El nombre de usuario es obligatorio.',
            'username.max' => 'El nombre de usuario no debe exceder los 15 caracteres.',
            'username.unique' => 'Éste nombre de usuario ya está registrado.',
            'dni.required' => 'El número de identidad es obligatorio.',
            'dni.unique' => 'Éste número de identidad ya está registrado.',
            'dni.digits' => 'El número de identidad debe contener 13 digitos sin espacios ni guiones.',
            'birthday.required' => 'La fecha de nacimiento es obligatoria.',
            'birthday.date' => 'Este campo debe ser insertado en formato de fecha.',
            'mobile.required' => 'El número celular es obligatorio.',
            'mobile.unique' => 'Éste número celular ya está registrado.',
            'mobile.digits' => 'El número celular debe contener 8 dígitos sin espacios ni guiones.',
            'address.required' => 'La dirección es obligatoria.',
            'address.max' => 'La dirección no debe exceder los 100 caracteres.',
            'email.required' => 'El email es obligatorio.',
            'email.unique' => 'Éste email ya está registrado.',
            'email.email' => 'El email ingresado no es válido.',
            'email.max' => 'El email no debe exceder los 100 caracteres.',
        ];
    }
}
