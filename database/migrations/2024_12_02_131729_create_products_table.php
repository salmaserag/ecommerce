<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code',30 )->unique();
            $table->string('name',30 );
            $table->string('marka',30 )->nullable();
            $table->text('description')->nullable();
            $table->string('photo')->nullable();
            $table->unsignedInteger('price')->nullable();
            $table->unsignedInteger('quantity')->nullable();

            $table->foreignId('category_id')
            ->nullable()
            ->constrained('categories')
            ->nullOnDelete();

            $table->foreignId('created_by')
            ->constrained('admins')
            ->restrictOnDelete();

            $table->foreignId('updated_by')
            ->nullable()
            ->constrained('admins')
            ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
