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
        Schema::table('workouts', function (Blueprint $table) {
            $table->dropColumn('start_time');
            $table->dropColumn('end_time');

            $table->dateTime('start_at')->after('routine_id');
            $table->dateTime('end_at')->after('start_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('workouts', function (Blueprint $table) {
            $table->dropColumn('start_at');
            $table->dropColumn('end_at');

            $table->time('start_time')->after('routine_id');
            $table->time('end_time')->after('start_time');
        });
    }
};
