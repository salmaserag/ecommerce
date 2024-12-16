<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

         Admin::create([
           'name' =>'Salma Hamdy',
           'email'=>'s@s.com',
           'password'=>Hash::make('salmahamdy'),

        ]);

        $admin  = Admin::create([
            'name' =>'Esraa Roshdy',
            'email'=>'e@e.com',
            'password'=>Hash::make('esraaroshdy'),

         ]);




         Admin::factory()->count(10)->create();
    }
}
