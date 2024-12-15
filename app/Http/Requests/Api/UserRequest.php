<?php

namespace App\Http\Requests\Api;

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
        //dd($this->routeIs('api.'));

        $data = [
            'name' => 'required|string|max:100|min:3',
            'email' => 'required|string|email|unique:users,email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|string|in:male,female',
            'age' => 'nullable|integer',
            'photo' => 'nullable|image|max:2048|mimes:png,jpg,jpeg'
        ];
       
        if ($this->routeIs('api.users.update')) {
            
            $user = $this->route('user'); // Retrieve the route parameter
            $userId = is_object($user) ? $user->id : $user; // Get ID if object

            $data['email'] = 'nullable|string|email|unique:users,email,' . $userId;
            $data['password'] = ['nullable'];

            //sometimes|required
        }
        
        return $data;
    }
}
