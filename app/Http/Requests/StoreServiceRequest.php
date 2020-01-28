<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
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
            'name'=>'required|max:100',
            'description'=>'required|max:100',
            'sale_price'=>'required',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.max' => 'El nombre no debe exceder los 100 caracteres.',
            'description.required' => 'La descripción es obligatoria.',
            'description.max' => 'La descripción no debe exceder los 100 caracteres.',
            'sale_price.required'=>'El precio de venta es obligatorio.',
            'image.image' =>'El archivo debe ser una imagen.',
            'image.mime' =>'La imagen debe ser de alguno de éstos formatos: jpeg,png,jpg,gif,svg.',
            'image.max' =>'La imagen no debe pesar más de 2 MB.',

        ];
    }


}
