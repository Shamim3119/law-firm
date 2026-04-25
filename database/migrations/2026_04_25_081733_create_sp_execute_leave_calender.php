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
                DROP PROCEDURE IF EXISTS sp_execute_leave_calender;
                CREATE  PROCEDURE sp_execute_leave_calender(title varchar(50))
                BEGIN

                    SET @f_year = Year(now());

                    INSERT INTO leave_calendars (`year`,`title`)VALUES(@f_year, title);

                    SET @fs_id = (select max(id) from leave_calendars);

                    SET @date = concat(@f_year, '-01-01');
                    SET @lp_year = (SELECT fnc_is_leap_year(@date));
                    SET @counte = 365;
                    if(@lp_year = 1)
                    then
                        SET @counte = 366;
                    end if;

                    SET @j = 0;
                    WHILE @counte > @j DO
                        SET @cur_date = (Select DATE_ADD(@date,INTERVAL @j DAY));
                        SET @day_name = DAYNAME(@cur_date);
                            INSERT INTO leave_calendar_details(`leave_calendar_id`,`year`, `date`, `day`, `created_at`,`updated_at`)values
                            (@fs_id, @f_year, @cur_date, @day_name, now(), now());
                        SET @j = @j + 1;
                    END WHILE;

                END
        
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_execute_leave_calender");
    }
};
