<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('members', function (Blueprint $table) {
            $table->enum('role', ['admin', 'tim', 'member'])
                  ->default('member')
                  ->after('alamat');
        });
    }

    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn('role');
        });

        Schema::table('members', function (Blueprint $table) {
            $table->enum('status', ['active', 'inactive'])
                  ->default('active');
        });
    }
};
