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
        Schema::create('leave_calendar_details', function (Blueprint $table) {
            $table->id();
            $table->integer('leave_calendar_id');
            $table->integer('year');
            $table->date('date');
            $table->string('day');
            $table->tinyInteger('holy_day')->default(0);
            $table->tinyInteger('flexible_day')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_calendar_details');
    }
};
