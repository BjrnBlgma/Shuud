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
        Schema::create('tournament_participants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tournament_id');
            $table->unsignedBigInteger('participant_id');
            $table->string('participant_type');
            $table->boolean('is_confirmed')->default(false);
            $table->timestamps(0);
            $table->enum('status', [
                "participating",
                "withdrawing_from_tournament",
                "awaiting_confirmation",
                "standby",
                "unavailable_for_participation",
                "requesting_a_delay",
                "requesting_changes",
                null
            ])->nullable()->default(null);

            $table->foreign('tournament_id')->references('id')->on('tournaments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournament_participants');
    }
};
