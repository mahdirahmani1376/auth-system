<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('provider')->nullable()->after('id');
            $table->string('provider_id')->nullable()->after('id');
            $table->string('avatar')->nullable()->after('remember_token');
            $table->string('password')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'avatar','password','provider','provider_id'
            ]);
            $table->string('password')->nullable(false)->change();
        });
    }
};
