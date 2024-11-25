<?php

namespace App\Http\Controllers\Dashboard;

use Exception;
use App\Models\Role;
use Illuminate\Http\Request;
use App\DataTables\RolesDataTable;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RolesDataTable $dataTable)
    {
        return $dataTable->render('dashboard.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::select('id', 'name')->get();
        return view('dashboard.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        // dd($request);
        $gardName = config('auth.defaults.guard');
        //dd($request , Auth::id());
        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description,
            'guard_name' => $gardName,
            'created_by' => Auth::id(),
        ]);

        //TODO:: you can replace this loop with spatie functions
        foreach ($request->permission_id as $permission) {
            DB::table('role_has_permissions')->insert([
                'permission_id' => $permission,
                'role_id' => $role->id,
            ]);
        }



        return redirect()->route('roles.index')->with('success', 'created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {

        // Fetch all permissions associated with the role
        //TODO:: rename  $ss with any other related name

        $ss = DB::table('role_has_permissions')->where('role_id', $role->id)->get();

        // Extract permission IDs from the collection
        $permissionIds = $ss->pluck('permission_id');

        // Fetch the permissions using the extracted IDs
        $permissions = DB::table('permissions')->whereIn('id', $permissionIds)->get();


        //dd($permissions);
        return view('dashboard.roles.show', compact('role' , 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::select('id', 'name')->get();
        return view('dashboard.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role)
    {
        $gardName = config('auth.defaults.guard');


        $role->update([
            'name' => $request->name,
            'description' => $request->description,
            'guard_name' => $gardName,
            'updated_by' => Auth::id(),

        ]);


        DB::table('role_has_permissions')->where('role_id', $role->id)->delete();

        foreach ($request->permission_id as $permission) {
            DB::table('role_has_permissions')->insert([
                'role_id' => $role->id,
                'permission_id' => $permission,

            ]);
        }

        return redirect()->route('roles.index')->with('success', 'created successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        if ($role->permissions()->exists()) {
            $role->permissions()->detach(); // Detaches all roles from the pivot table
        }

        // Delete the user
        $role->delete();

        return redirect()->back();
    }
}
