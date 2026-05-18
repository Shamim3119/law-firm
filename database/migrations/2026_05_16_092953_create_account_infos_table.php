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
        Schema::create('account_infos', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type_id')->default(0);
            $table->unsignedBigInteger('bank_id')->default(0);
            $table->unsignedBigInteger('ref_id')->default(0);
            $table->tinyInteger('ref_type_id')->default(0);
            $table->string('code');
            $table->string('name');
            $table->string('description')->nullable();
            $table->tinyInteger('inactive')->default(0); // 0 = active, 1 = inactive    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_infos');
    }
};
