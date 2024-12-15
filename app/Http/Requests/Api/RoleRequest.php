<?php

namespace App\Http\Requests\Api;

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
        if ($this->routeIs('api.roles.update')) {

            $role = $this->route('role'); // Retrieve the route parameter
            $roleId = is_object($role) ? $role->id : $role; // Get ID if object

            $data['name'] = 'nullable|string|unique:roles,name,'.$roleId;
         }
       
        return $data;
    }
}
