<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointment_status', function (Blueprint $table) {
            $table->id(); // auto increment id
            $table->string('name'); // string field
            $table->timestamps();
        });

        // Insert basic data
        DB::table('appointment_status')->insert([
            ['name' => 'Opend', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Reopend', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Accepted', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rejected', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Applyed', 'created_at' => now(), 'updated_at' => now()], 
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('appointment_status');
    }
};