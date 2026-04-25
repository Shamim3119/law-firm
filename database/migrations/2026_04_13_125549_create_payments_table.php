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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('type_id')->default(0); 
            $table->decimal('amount', 10, 2); 
            $table->decimal('active_amount', 10, 2); 
            $table->decimal('next_amount', 10, 2);   
            $table->string('remarks');  
            $table->unsignedBigInteger('case_id'); 
            $table->unsignedBigInteger('client_id');  
            $table->unsignedBigInteger('employee_id');  
            $table->unsignedBigInteger('appointment_id');  
            $table->timestamps();
        });
    }
 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
