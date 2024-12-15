<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name'=> 'required|string|max:100|min:3',
            'code' => 'required|string|unique:products,code',
            'description'=> 'nullable|string|max:500|min:5',
            'marka'=> 'nullable|string|max:30|min:3',
            'quantity'=>'nullable|integer',
            'price'=>'nullable|integer',
            'photo' =>'nullable|image|max:2048|mimes:png,jpg,jpeg'
        ];
        if ($this->routeIs('users.update')) {
            $data['code'] = 'required|string|unique:products,code,'.$this->route('product')->id;
         }
        
        return $data;
    }
}
