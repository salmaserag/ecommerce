<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // User::truncate();
        //$user =
         User::create([
           'name' =>'Salma Hamdy',
           'email'=>'s@s.com',
           //'role' => 'super admin',
           //'status' =>'active',
           'password'=>Hash::make('salmahamdy'),
           
        ]);
        //$user->assignRole('super admin');

        DB::table('users')->insert([
            'name' =>'Mohammed Gamal',
            'email'=>'m@m.com',
            'password'=>Hash::make('mohammed'),
           
         ]);

         User::factory()->count(10)->create();
    }
}
