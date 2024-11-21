<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Role;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\DataTables\UsersDataTable;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Models\UserDetailes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('dashboard.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::select('id', 'name')->get();         //to show roles is selection
        return view('dashboard.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {

        $photo = null;   //initial value
       
            if ($request->has('photo')) {
                $photo =  Storage::putFileAs('image/Users', $request->photo, date_format(now(), 'Y-m-d') . '_' . $request->name . '_photo');
            }

            try{
            DB::beginTransaction();                 //when i try to create in many tables at same time
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'created_by' => Auth::id(),

            ]);

            UserDetailes::create([
                'gender' => $request->gender,
                'age' => $request->age,
                'phone' => $request->phone,
                'address' => $request->address,
                'photo' => $photo,
                'user_id' => $user->id,

            ]);

            $roles = Role::whereIn('id',$request->roles)->get();                //when retuened roles == roles in mode "Role" get()
            $user->assignRole($roles);                                          //assign this equal rile to user 

        DB::commit();                         //okay done 


        return redirect()->route('users.index')->with('success', 'created successfully');
        }catch(Exception $e)
        {

            DB::rollBack();               //if error in any table rollBack all 
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {

        return view('dashboard.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::select('id', 'name')->get();                        //get from table role "id , name"

        return view('dashboard.users.edit', compact('user' , 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $photo = null;


        if ($request->has('photo')) {
            if (optional($user->detailes)->photo && Storage::exists($user->detailes->photo)) {
                Storage::delete($user->detailes->photo);
            }
            $photo =  Storage::putFileAs('image/Users', $request->photo, date_format(now(), 'Y-m-d') . '_' . $request->name . '_photo');
        }

        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'updated_by' => Auth::id(),
            ]);

            if ($user->details) {
                $user->details->update([
                    'gender' => $request->gender,
                    'age' => $request->age,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'photo' => $photo,
                ]);
            } else {
                UserDetailes::create([
                    'gender' => $request->gender,
                    'age' => $request->age,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'photo' => $photo,
                    'user_id'=>$user->id
                ]);
            }

            DB::table('model_has_roles')->where('model_id', $user->id)->delete();
            
            foreach ($request->roles as $role) {
                DB::table('model_has_roles')->insert([
                    'model_id' => $user->id,
                    'role_id' => $role,
                    'model_type' => 'App\Models\User',
                ]);
            }
       

        } catch (Exception $e) {
            return redirect()->back()->withErrors('failed');
        }
        return redirect()->route('users.index')->with('success', 'created successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {

        //dd($user->roles);
        if ($user->detailes) {
            if ($user->detailes->photo && Storage::exists($user->detailes->photo)) {
                Storage::delete($user->detailes->photo);
            }
            $user->detailes->delete();
        }
        
        // Detach all roles associated with the user
        if ($user->roles()->exists()) {
            $user->roles()->detach(); // Detaches all roles from the pivot table
        }
        
        // Delete the user
        $user->delete();
        
        return redirect()->back();
    }
}
