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
       
{
    Schema::table('artworks', function (Blueprint $table) {
        $table->string('sketsa_image')->nullable();
        $table->string('color_image')->nullable();
        $table->string('final_image')->nullable();
        $table->enum('status', ['sketsa', 'color', 'final'])->default('sketsa');
    });
}

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('artworks', function (Blueprint $table) {
            //
        });
    }
};
