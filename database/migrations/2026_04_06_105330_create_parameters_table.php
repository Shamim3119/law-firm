<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('parameters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tag');
            $table->tinyInteger('inactive')->default(0); // 0 = active, 1 = inactive
            $table->timestamps();
        });

        DB::table('parameters')->insert([
            ['id'=>1,'name'=>'HR','tag'=>'department','created_at'=>null,'updated_at'=>null,'inactive'=>0],
            ['id'=>2,'name'=>'IT','tag'=>'department','created_at'=>null,'updated_at'=>null,'inactive'=>0],
            ['id'=>3,'name'=>'Finance','tag'=>'department','created_at'=>null,'updated_at'=>null,'inactive'=>0],
            ['id'=>4,'name'=>'Marketing','tag'=>'department','created_at'=>null,'updated_at'=>null,'inactive'=>0],
            ['id'=>5,'name'=>'Sales','tag'=>'department','created_at'=>null,'updated_at'=>null,'inactive'=>0],

            ['id'=>6,'name'=>'Lawyer','tag'=>'designation','created_at'=>null,'updated_at'=>null,'inactive'=>0],
            ['id'=>7,'name'=>'Manager','tag'=>'designation','created_at'=>null,'updated_at'=>null,'inactive'=>0],
            ['id'=>8,'name'=>'Developer','tag'=>'designation','created_at'=>null,'updated_at'=>null,'inactive'=>0],
            ['id'=>9,'name'=>'Accountant','tag'=>'designation','created_at'=>null,'updated_at'=>null,'inactive'=>0],
            ['id'=>10,'name'=>'Analyst','tag'=>'designation','created_at'=>null,'updated_at'=>null,'inactive'=>0],
            ['id'=>11,'name'=>'Intern','tag'=>'designation','created_at'=>null,'updated_at'=>null,'inactive'=>0],

            ['id'=>12,'name'=>'Male','tag'=>'gender','created_at'=>null,'updated_at'=>null,'inactive'=>0],
            ['id'=>13,'name'=>'Female','tag'=>'gender','created_at'=>null,'updated_at'=>null,'inactive'=>0],

            ['id'=>14,'name'=>'Islam','tag'=>'religion','created_at'=>null,'updated_at'=>null,'inactive'=>0],
            ['id'=>15,'name'=>'Christianity','tag'=>'religion','created_at'=>null,'updated_at'=>null,'inactive'=>0],
            ['id'=>16,'name'=>'Hinduism','tag'=>'religion','created_at'=>null,'updated_at'=>null,'inactive'=>0],
            ['id'=>17,'name'=>'Buddhism','tag'=>'religion','created_at'=>null,'updated_at'=>null,'inactive'=>0],
            ['id'=>18,'name'=>'Judaism','tag'=>'religion','created_at'=>null,'updated_at'=>null,'inactive'=>0],

            ['id'=>19,'name'=>'Casual leave','tag'=>'leave-type','created_at'=>null,'updated_at'=>null,'inactive'=>0],
            ['id'=>20,'name'=>'Annual leave','tag'=>'leave-type','created_at'=>null,'updated_at'=>null,'inactive'=>0],
            ['id'=>21,'name'=>'Sick Leave','tag'=>'leave-type','created_at'=>null,'updated_at'=>null,'inactive'=>0],

            ['id'=>22,'name'=>'Consultation','tag'=>'appointment-type','created_at'=>'2026-04-25 01:24:12','updated_at'=>'2026-04-25 01:24:12','inactive'=>0],
            ['id'=>23,'name'=>'Follow-up','tag'=>'appointment-type','created_at'=>'2026-04-25 01:24:28','updated_at'=>'2026-04-25 01:24:28','inactive'=>0],
            ['id'=>24,'name'=>'New Appointment','tag'=>'appointment-type','created_at'=>'2026-04-25 01:24:39','updated_at'=>'2026-04-25 01:24:39','inactive'=>0],
            ['id'=>25,'name'=>'Emergency','tag'=>'appointment-type','created_at'=>'2026-04-25 01:24:48','updated_at'=>'2026-04-25 01:24:48','inactive'=>0],
            ['id'=>26,'name'=>'Routine Check','tag'=>'appointment-type','created_at'=>'2026-04-25 01:24:59','updated_at'=>'2026-04-25 01:24:59','inactive'=>0],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parameters');
    }
};
