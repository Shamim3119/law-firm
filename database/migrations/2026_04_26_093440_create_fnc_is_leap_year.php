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
        DB::unprepared(" 
                CREATE FUNCTION `fnc_is_leap_year`(today datetime) RETURNS int

                READS SQL DATA
                DETERMINISTIC

                BEGIN

                DECLARE leap_year INT;

                IF ((SELECT MOD(YEAR(today),4) = 0) AND (SELECT MOD(YEAR(today),100) != 0))
                THEN
                    SET leap_year = 1;
                ELSEIF (SELECT MOD(YEAR(today),400) = 0)
                THEN
                SET leap_year = 1;
                ELSE
                SET leap_year =0;
                END IF;

                RETURN leap_year;

                END        
            ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fnc_is_leap_year');
    }
};
