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
        Schema::create('cases', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('title');
            $table->string('descriptions');
            $table->unsignedBigInteger('appointment_id')->nullable();
            $table->unsignedInteger('client_id')->nullable();
            $table->unsignedInteger('employee_id')->nullable();
            $table->decimal('charge', 16, 2)->default(0.00);
            $table->decimal('payment', 16, 2)->default(0.00);
            $table->decimal('due', 16, 2)->default(0.00);
            $table->integer('hearing_counter')->default(0);
            $table->integer('court_counter')->default(0);       
            $table->string('court_no', 45)->nullable();
            $table->string('court_name', 45)->nullable();
            $table->date('hearing_date')->nullable();
            $table->time('hearing_time')->nullable();
            $table->tinyInteger('status_id')->default(0);   
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cases');
    }
};
