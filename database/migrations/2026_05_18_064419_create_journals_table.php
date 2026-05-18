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
        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dr_id')->nullable();
            $table->unsignedBigInteger('cr_id')->nullable();

            $table->decimal('dr_amount', 10, 2)->unsigned()->nullable();
            $table->decimal('cr_amount', 10, 2)->unsigned()->nullable();

            $table->decimal('dr_before', 10, 2)->nullable();
            $table->decimal('cr_before', 10, 2)->nullable();

            $table->decimal('dr_after', 10, 2)->nullable();

            $table->string('cr_after', 45)->nullable();

            $table->string('description', 250)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journals');
    }
};
