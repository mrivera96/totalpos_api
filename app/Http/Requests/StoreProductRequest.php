<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name'=>'required',
            'description'=>'required|max:100',
            'barcode'=>'required|unique:products',
            'cost'=>'required',
            'sale_price'=>'required',
            'in_stock'=>'required',
            'brand'=>'required|max:100',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'description.required' => 'La descripción es obligatoria.',
            'description.max' => 'La descripción no debe exceder los 100 caracteres.',
            'barcode.required'=>'El código de barra es obligatorio.',
            'barcode.unique'=>'Éste código de barra ya está registrado.',
            'cost.required'=>'El costo es obligatorio.',
            'sale_price.required'=>'El precio de venta es obligatorio.',
            'in_stock.required'=>'La existencia es obligatoria.',
            'brand.required'=>'La marca es obligatoria.',
            'brand.max'=>'el nombre de la marca no debe exceder los 100 caracteres.',
            'image.image' =>'El archivo debe ser una imagen.',
            'image.mime' =>'La imagen debe ser de alguno de éstos formatos: jpeg,png,jpg,gif,svg.',
            'image.max' =>'La imagen no debe pesar más de 2 MB.',

        ];
    }



}
