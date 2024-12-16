<?php

use App\Models\Category;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();



Artisan::command("category" , function(){

    Category::create([
        'name' => "dddd",
        'description' => "ddddddddddd",
        'created_by' => 1,

    ]);

    $this->info('added success');
})->describe("add new category");
