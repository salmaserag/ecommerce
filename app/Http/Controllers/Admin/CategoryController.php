<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\CreateCategory;
use App\Http\Requests\CategoryRequest;
use App\DataTables\CategoriesDataTable;
use Illuminate\Support\Facades\Notification;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoriesDataTable $dataTable)
    {
        return $dataTable->render('dashboard.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $Category = Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'created_by' => Auth::guard('admin')->id(),

        ]);



        $created_by = auth()->guard('admin')->user()->name;
        // Get all admins except the one who created the category
        $admins = Admin::where('id', '!=', Auth::guard('admin')->id())->get();

        // Send notification to each admin
        foreach ($admins as $admin) {
            Notification::send($admin, new CreateCategory($created_by, $Category->id, $Category->name, $Category->description));
        }
        return redirect()->route('categories.index')->with('success', 'created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {

        return view('dashboard.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'updated_by' => Auth::guard('admin')->id(),

        ]);

        return redirect()->route('categories.index')->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->back();
    }



    public function allCategory()
    {
        $categories = DB::table('categories')->get();
        return view('website.shop', compact('categories'));
    }


    public function categoryProducts(Category $category)
    {

        return view('website.product', compact('category'));
    }



    public function notification($id)
    {

        // Find the category by ID
        $category = Category::findOrFail($id);

        // Get the IDs of the notifications related to this category
        $getIds = DB::table('notifications')
            ->where('data->category_id', $id)
            ->pluck('id');

        // If notifications are found, mark them as read
        if ($getIds->isNotEmpty()) {
            DB::table('notifications')
                ->whereIn('id', $getIds)
                ->update(['read_at' => now()]);
        }
        return view('dashboard.categories.show', compact('category'));
    }


    public function markAsRead()
    {

        $admin = Admin::find(Auth::guard('admin')->id());
        foreach($admin->unreadNotifications as $notification){
             $notification->markAsRead();
            // $notification->delete();      //delete it from DB

        }
        return redirect()->back();

    }
}
