<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Unique;

class UpdateProductRequest extends FormRequest
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
            // 'category_id' => 'required',
            'sku' => 'required|unique:products,sku,{$this->products}',
            'name' => 'required|numeric',
            'price' =>'required|numeric|min:0',
            'img' => 'sometimes|image',
            'quantity' =>'required|numeric'
        ];
    }
}
