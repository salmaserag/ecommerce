<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email' => 'required|string|email|unique:users,email',
            'password' =>  ['required', 'confirmed', Rules\Password::defaults()],
            'address'=>'nullable|string|max:500',
            'address'=>'nullable|string|max:500',
            'phone'=>'nullable|string|max:20',
            'gender'=> 'nullable|string|in:male,female',
            'age'=>'nullable|integer',
            'photo' =>'nullable|image|max:2048|mimes:png,jpg,jpeg'
        ];
        if ($this->routeIs('users.update')) {
            $data['email'] = 'required|string|email|unique:users,email,'.$this->route('user')->id;
            $data['password'] = ['nullable'];
         }
         //dd($data,$this->route('user')->id);
        return $data;
    }
}
