<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('project_id')->nullable();

            // Pengirim & penerima
            $table->foreignId('from_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->foreignId('to_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // Konten
            $table->text('message')->nullable();        // text only
            $table->string('file_path')->nullable();    // image / video / document

            $table->enum('type', [
                'text',
                'image',
                'video',
                'document'
            ])->default('text');

            // Status
            $table->boolean('is_read')->default(false);
            $table->boolean('is_delivered')->default(false);

            $table->timestamps();

            // Performance index
            $table->index(['from_id', 'to_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
