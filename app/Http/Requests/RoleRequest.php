<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'name'=> 'required|string|max:100|min:3|unique:roles,name',
            'description' => 'nullable|string',
            'guard_name' =>'string' ,
           
        ];
        if ($this->routeIs('roles.update')) {
            $data['name'] = 'required|string|unique:roles,name,'.$this->route('role')->id;
         }
       
        return $data;
    }
}
