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
        Schema::create('artwork_progress', function (Blueprint $table) {
    $table->id();

    $table->foreignId('artwork_id')->constrained()->cascadeOnDelete();

    $table->enum('stage', ['sketsa','color','final']);

    $table->string('image');

    $table->text('note')->nullable();

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artwork_progress');
    }
};
