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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('descriptions');
            $table->integer('employee_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->string('appointment_details')->nullable();
            $table->integer('appointment_type_id')->unsigned();
            $table->date('appointment_date');
            $table->time('appointment_start_time');
            $table->time('appointment_end_time');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
