<?php

namespace Database\Seeders;


use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
         Category::create([
           'name' =>'cat',
           'description'=>'all about cat',
           'created_by' =>1
           
        ]);

        Category::create([
            'name' =>'dog',
            'description'=>'all about dog',
            'created_by' =>1
            
         ]);

         Category::create([
            'name' =>'bird',
            'description'=>'all about bird',
            'created_by' =>1
            
         ]);

         Category::create([
            'name' =>'clothes',
            'description'=>'all about clothes',
            'created_by' =>1
            
         ]);

         Category::create([
            'name' =>'food',
            'description'=>'all about food',
            'created_by' =>1
            
         ]);

         Category::create([
            'name' =>'toy',
            'description'=>'all about toy',
            'created_by' =>1
            
         ]);

         Category::create([
            'name' =>'clean',
            'description'=>'all about clean',
            'created_by' =>1
            
         ]);
        

    }
}
