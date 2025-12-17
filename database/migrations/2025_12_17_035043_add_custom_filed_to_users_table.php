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
        Schema::table('users', function (Blueprint $table) {
            $table->string('nip')->unique()->after('id');
            $table->string('jabatan')->nullable()->after('name');
            $table->string('unit_kerja')->nullable()->after('jabatan');
            $table->enum('role', ['admin', 'staff'])->default('staff')->after('unit_kerja');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nip', 'jabatan', 'unit_kerja', 'role']);
        });
    }
};
