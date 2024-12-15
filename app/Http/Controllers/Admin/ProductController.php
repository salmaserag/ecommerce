<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\DataTables\ProductsDataTable;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductsDataTable $dataTable)
    {
        return $dataTable->render('dashboard.products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        return view('dashboard.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $photo = null;   //initial value

        if ($request->has('photo')) {
            $photo =  Storage::putFileAs('image/Products', $request->photo, date_format(now(), 'Y-m-d') . '_' . $request->code . '_photo');
        }

        try {
            DB::beginTransaction();                 //when i try to create in many tables at same time
            $product = Product::create([
                'name' => $request->name,
                'code' => $request->code,
                'marka' => $request->marka,
                'description' => $request->description,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'photo' => $photo,
                'created_by' => Auth::guard('admin')->id(),

            ]);

            foreach ($request->categories as $category) {
                ProductCategory::create([
                    'product_id' => $product->id,
                    'category_id' => $category
                ]);
            }


            DB::commit();                         //okay done 


            return redirect()->route('products.index')->with('success', 'created successfully');
        } catch (Exception $e) {

            DB::rollBack();               //if error in any table rollBack all 
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('dashboard.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::select('id', 'name')->get();                        //get from table role "id , name"

        return view('dashboard.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $photo = null;


        if ($request->has('photo')) {
            if (Storage::exists($product->photo)) {
                Storage::delete($product->photo);
            }
            $photo =  Storage::putFileAs('image/Products', $request->photo, date_format(now(), 'Y-m-d') . '_' . $request->code . '_photo');
        }

        try {
            $product->update([
                'name' => $request->name,
                'code' => $request->code,
                'marka' => $request->marka,
                'description' => $request->description,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'photo' => $photo,
                'updated_by' => Auth::guard('admin')->id(),
            ]);



            DB::table('product_categories')->where('product_id', $product->id)->delete();

            foreach ($request->categories as $category) {
                DB::table('product_categories')->insert([
                    'product_id' => $product->id,
                    'category_id' => $category,
                ]);
            }
        } catch (Exception $e) {
            return redirect()->back()->withErrors('failed');
        }
        return redirect()->route('products.index')->with('success', 'updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {

        if ($product->photo && Storage::exists($product->photo)) {
            Storage::delete($product->photo);
        }

        if ($product->categories()->exists()) {
            $product->categories()->detach(); // Detaches all roles from the pivot table
        }

        $product->delete();

        return redirect()->back();
    }
}
