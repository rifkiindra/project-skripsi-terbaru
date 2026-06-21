<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->enum('role', [
                'admin',
                'manajer',
                'direktur',
                'tim',
                'member'
            ])->default('member')->change();
        });
    }

    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->enum('role', [
                'admin',
                'tim',
                'member'
            ])->default('member')->change();
        });
    }
};
