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
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string('appointment_status'); // string field
            $table->string('case_status'); // string field
            $table->timestamps();
        });

        DB::table('statuses')->insert([
            ['appointment_status' => 'Opend', 'case_status' => 'Pending', 'created_at' => now(), 'updated_at' => now()],
            ['appointment_status' => 'Reopend', 'case_status' => 'Pending', 'created_at' => now(), 'updated_at' => now()],
            ['appointment_status' => 'Accepted', 'case_status' => 'In Progress', 'created_at' => now(), 'updated_at' => now()],
            ['appointment_status' => 'Rejected', 'case_status' => 'Closed', 'created_at' => now(), 'updated_at' => now()],
            ['appointment_status' => 'Applyed', 'case_status' => 'Pending', 'created_at' => now(), 'updated_at' => now()], 
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statuses');
    }
};
