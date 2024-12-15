<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Models\Role;
use App\Models\User;
use App\Models\UserDetailes;
use Illuminate\Http\Request;
use App\Http\Requests\Api\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Api\ApiResponseTrait;

class UserController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        $users = User::with(['roles:id,name,guard_name' ,'detailes', 'createdBy', 'updatedBy'])->get();
        $users = UserResource::collection($users);
        return $this->apiResponse(true, 'All Users', $users, 200);


    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return $this->apiResponse(false, 'not found', null, 404);

        }

        return $this->apiResponse(true, 'done', new userResource($user), 200);

    }


    public function store(UserRequest $request)
    {


        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'created_by' => Auth::guard('api')->id(),

            ]);


            UserDetailes::create([
                'gender' => $request->gender,
                'age' => $request->age,
                'phone' => $request->phone,
                'address' => $request->address,
                'user_id' => $user->id,

            ]);

            $roles = Role::WhereIn('id', json_decode($request->role_ids))->where('guard_name','web')->get();
            
            $user->assignRole($roles);

            DB::commit();

            return $this->apiResponse(true, 'User Saved', new UserResource($user), 201);

        } catch (Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
        }



    }

    public function update(UserRequest $request, $id)
    {
        //dd($request);
        
        $user = User::find($id);

        if (!$user) {
            return $this->apiResponse(false, 'user not found', null, 404);

        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email ? $request->email : $user->email ,
            'updated_by' => Auth::guard('api')->id(),
        ]);

        if ($user->details) {
            $user->details->update([
                'gender' => $request->gender,
                'age' => $request->age,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
        } else {
            UserDetailes::create([
                'gender' => $request->gender,
                'age' => $request->age,
                'phone' => $request->phone,
                'address' => $request->address,
                'user_id' => $user->id
            ]);
        }


        DB::table('model_has_roles')->where('model_id', $user->id)->delete();

        $roles = Role::WhereIn('id', json_decode($request->role_ids))->where('guard_name','web')->get();
        $user->assignRole($roles);

        return $this->apiResponse(true, 'User Updated', new UserResource($user), 201);

    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return $this->apiResponse(false, 'user not found', null, 404);

        }


        if ($user->detailes) {
            if ($user->detailes->photo && Storage::exists($user->detailes->photo)) {
                Storage::delete($user->detailes->photo);
            }
            $user->detailes->delete();
        }


        if ($user->roles()->exists()) {
            $user->roles()->detach();
        }


        if ($user->delete($id)) {
            return $this->apiResponse(true, 'User deleted', new UserResource($user), 201);
        }

        return $this->apiResponse(false, 'user not deleted', null, 404);


    }


}
