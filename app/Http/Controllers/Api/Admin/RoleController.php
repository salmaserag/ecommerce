<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\Api\RoleRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\ApiResponseTrait;

class RoleController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $roles = Role::with(['createdBy', 'updatedBy'])->get();
        $roles = RoleResource::collection($roles);
        return $this->apiResponse(true, 'All Users', $roles, 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
       
        try{
            DB::beginTransaction();

            $role = Role::create([
                'name' => $request->name,
                'description' => $request->description ? $request->description : "null",
                'guard_name' => $request->guard,
                'created_by' => Auth::guard('api')->id(),

            ]);


            if (!$role) {
                return $this->apiResponse(false, 'role not saved', null, 400);
            }
          
         
            $permissionIds = json_decode($request->permission_ids);

            foreach ($permissionIds as $permission) {
                DB::table('role_has_permissions')->insert([
                    'permission_id' => $permission,
                    'role_id' => $role->id,
                ]);
            }


            DB::commit();

            return $this->apiResponse(true, 'Role Saved', new RoleResource($role), 201);


        } catch (Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
        } 

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::find($id);
        if (!$role) {
            return $this->apiResponse(false, 'not found', null, 404);

        }

        return $this->apiResponse(true, 'done', new RoleResource($role), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, $id)
    {
        $role = Role::find($id);

        if (!$role) {
            return $this->apiResponse(false, 'Role not found', null, 404);

        }

        $role->update([
            'name' => $request->name ? $request->name : $role->name,
            'description' => $request->description ? $request->description : $role->description,
            'guard_name' => $request->guard_name ? $request->guard_name : $role->guard_name,
            'updated_by' => Auth::guard('api')->id(),

        ]);


        DB::table('role_has_permissions')->where('role_id', $role->id)->delete();



         $permissionIds = json_decode($request->permission_ids);

            foreach ($permissionIds as $permission) {
                DB::table('role_has_permissions')->insert([
                    'permission_id' => $permission,
                    'role_id' => $role->id,
                ]);
            }


            return $this->apiResponse(true, 'Role Updated', new RoleResource($role), 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);

        if (!$role) {
            return $this->apiResponse(false, 'role not found', null, 404);

        }


        if ($role->permissions()->exists()) {
            $role->permissions()->detach(); // Detaches all roles from the pivot table
        }



        if ($role->delete($id)) {

            // dd(11);
            
            return $this->apiResponse(true, 'Role deleted', new RoleResource($role), 201);
        }

         return $this->apiResponse(false, 'role not deleted', null, 404);

    }
}
