<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use Illuminate\View\View;
use App\Models\UserDetailes;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
       // return view('auth.register');
       return view("website.register");
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'created_by' => ['nullable' , 'integer'],
            'gender' => ['nullable' , 'string' , 'in:female ,male'],
            'age' => ['nullable' , 'integer' ],
            'address' => ['nullable' , 'string' , 'max:500' , 'min:10'],
            'phone' => ['nullable' , 'string' , 'max:15' , 'min:11'],
            

        ]);



        $photo = null;   //initial value

        if ($request->has('photo')) {
            $photo =  Storage::putFileAs('image/Users', $request->photo, date_format(now(), 'Y-m-d') . '_' . $request->name . '_photo');
        }

        try {
            DB::beginTransaction();    

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->update([
            'created_by'=>$user->id
        ]);

        UserDetailes::create( [
            'gender' => $request->gender ,
            'age' =>   $request->age ,
            'phone' => $request->phone,
            'address' => $request->address,
            'photo' => $photo,
            'user_id' => $user->id,

        ]);

         
        DB::commit(); 
        
        //okay done 


        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('website');

    } catch (Exception $e) {

      dd($e->getMessage());
        DB::rollBack(); 
              //if error in any table rollBack all 
    }

    }
}
