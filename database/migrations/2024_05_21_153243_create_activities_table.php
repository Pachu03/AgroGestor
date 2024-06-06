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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('type_activity',20);
            $table->string('description',100);
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('state_activity');
            $table->foreignId('worker_user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('boss_user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropForeign(['worker_user_id']);
            $table->dropForeign(['boss_user_id']);
        });
        Schema::dropIfExists('activities');
    }
};
