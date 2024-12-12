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
        Schema::table('tournaments', function (Blueprint $table) {
            Schema::table('tournaments', function (Blueprint $table) {
                $table->string('status', 100)->default('upcoming')->change();

                $table->string('registration_token')->nullable()->unique();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tournaments', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('registration_token');
        });
    }
};
