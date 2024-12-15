<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
        $data =  [
            'product_id'=> 'required|int|exists:products,id',
            'quantity' => 'nullable|int|min:1',
           
        ];
        if ($this->routeIs('carts.update')) {
            $data =  [
                'product_id'=> 'required|int|exists:products,id',
                'quantity' => 'nullable|int|min:1',
               
            ];
         }
       
        return $data;
    }
    
}
