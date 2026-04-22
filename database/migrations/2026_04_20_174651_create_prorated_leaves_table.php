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
        Schema::create('prorated_leaves', function (Blueprint $table) {
            $table->id();
            $table->integer('schedule_id');
            $table->integer('leave_type_id');
            $table->integer('january');
            $table->integer('february');
            $table->integer('march');
            $table->integer('april');
            $table->integer('may');
            $table->integer('june');
            $table->integer('july');
            $table->integer('august');
            $table->integer('september');
            $table->integer('october');
            $table->integer('november');
            $table->integer('december');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prorated_leaves');
    }
};
