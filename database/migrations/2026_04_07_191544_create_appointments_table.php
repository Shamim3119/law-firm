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
            $table->string('code')->unique()->nullable();
            $table->integer('status_id')->unsigned()->default(1); // Default to 'Scheduled'
            $table->string('title');
            $table->string('descriptions');
            $table->integer('employee_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->string('details')->nullable();
            $table->integer('type_id')->unsigned();
            $table->date('start_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('note')->nullable();

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
