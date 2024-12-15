<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\ApiResponseTrait;

class CategoryController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        $categories = Category::get();
        //$categories = CategoryResource::collection(Category::get());
        return $this->apiResponse(true, 'All Catrgories', $categories, 200);


        // return response([
        //     'success'=>true,
        //     'message'=>'All Catrgories',
        //     'data'=>$categories,
        // ],200);
    }


    public function show($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return $this->apiResponse(false, 'not found', null, 404);

        }

        return $this->apiResponse(true, 'done', new CategoryResource($category), 200);

    }

    public function store(CategoryRequest $request)
    {

        $category = Category::create($request->all());

        if (!$category) {
            return $this->apiResponse(false, 'category not saved', null, 400);
        }

        return $this->apiResponse(true, 'Category Saved', new CategoryResource($category), 201);

    }

    public function update(CategoryRequest $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return $this->apiResponse(false, 'category not found', null, 404);

        }

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'updated_by' => $request->updated_by
        ]);

        return $this->apiResponse(true, 'Category Updated', new CategoryResource($category), 201);

    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return $this->apiResponse(false, 'category not found', null, 404);

        }

       if( $category->delete($id)){
        return $this->apiResponse(true, 'Category deleted', new CategoryResource($category), 201);
       }

       return $this->apiResponse(false, 'category not deleted', null, 404);


    }
}
