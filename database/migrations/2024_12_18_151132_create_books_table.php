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
        Schema::create('artworks', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('klien');
            $table->string('kategori', 100)->nullable();
            $table->integer('stok')->default(0);
            $table->timestamps();
        });

        echo "Table 'artworks' created successfully.\n";
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artworks');

        echo "Table 'artworka' dropped successfully.\n";
    }
};
