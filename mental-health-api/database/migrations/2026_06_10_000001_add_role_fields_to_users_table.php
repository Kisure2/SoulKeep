<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['user', 'therapist', 'admin'])->default('user')->after('email');
            $table->enum('status', ['active', 'pending', 'rejected'])->default('active')->after('role');
            $table->text('address')->nullable()->after('status');
            $table->string('avatar', 255)->nullable()->after('address');
            $table->text('bio')->nullable()->after('avatar');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'status', 'address', 'avatar', 'bio']);
        });
    }
};
