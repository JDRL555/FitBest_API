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
        Schema::create('sets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workout_id')->constrained("workouts", "id")->cascadeOnDelete();
            $table->foreignId('exercise_id')->constrained("exercises", "id");

            $table->integer('reps');

            $table->decimal('weight_count', 4, 1)->nullable();
            $table->enum('weight_type', ["kg", "bars"])->nullable();

            $table->integer('sets');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sets');
    }
};
