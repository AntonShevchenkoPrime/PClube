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
        Schema::create('games__libraries', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('tag');
            $table->string('name');
            $table->string('description');
            $table->string('rating')->nullable();
            $table->string('state');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games__libraries');
    }
};
