<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        'name' => 'required|string|max:100|min:3|unique:categories,name',
        'description' => 'nullable|string|min:3',
    ];

    if ($this->routeIs('categories.update')) {
        $category = $this->route('category'); // Retrieve the route parameter
        $categoryId = is_object($category) ? $category->id : $category; // Get ID if object
        
        $data['name'] = 'required|string|max:100|min:3|unique:categories,name,' . $categoryId;
    }

    return $data;
}

}
