<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:create {name} {description} {created_by}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create New Category';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Category::create([
            'name' => $this->argument('name'),
            'description' => $this->argument('description'),
            'created_by' => $this->argument('created_by'),

        ]);

        $this->info('added successfully');
    }
}
