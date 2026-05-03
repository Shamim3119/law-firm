<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->integer('department_id')->unsigned();
            $table->integer('designation_id')->unsigned();
            $table->integer('attendance_id')->unsigned()->default(0);
            $table->integer('leave_id')->unsigned()->default(0);
            $table->integer('calendar_id')->unsigned()->default(0); 
            $table->date('joining_date')->nullable();
            $table->timestamps();
        });

 
     //   Artisan::call('db:seed', [
      //      '--class' => 'EmployeeProcedureSeeder'
      //  ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
