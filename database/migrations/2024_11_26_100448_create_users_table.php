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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('surname', 50);
            $table->string('patronymic', 50)->nullable();
            $table->date('birthday');
            $table->string('email', 100)->unique();
            $table->string('password_hash', 255);
            $table->string('phone', 20);
            $table->string('city', 100);
            $table->string('region', 100);
            $table->unsignedBigInteger('role_id');
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->index(['name', 'surname', 'patronymic', 'birthday', 'city', 'region'], 'user_identity_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
