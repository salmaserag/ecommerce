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
        Schema::create('user_detailes', function (Blueprint $table) {
            $table->id();
            $table->enum('gender' , ['male' , 'female'])->nullable();
            $table->unsignedInteger('age')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('photo')->nullable();
            $table->foreignId('user_id')->constrained('users','id')->restrictOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_detailes');
    }
};
