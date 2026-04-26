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
            CREATE  PROCEDURE `sp_select_attendance`()
            BEGIN

            WITH RECURSIVE dates AS (
                SELECT DATE('2026-04-25') AS date
                UNION ALL
                SELECT DATE_ADD(date, INTERVAL 1 DAY)
                FROM dates
                WHERE date < '2026-04-26'
            )

            SELECT t.*,
            if(t.holiday = 1, description, if(t.flexible_day = 1, 'Flexible day', 'Working day')) as descp,
            if((ifnull(in_time, '') = '' and ifnull(in_time, '') = ''), 'Absent', 'Present') status
            FROM(SELECT 
                e.id AS employee_id,
                e.code,
                e.name,
                d.date,
                DAYNAME(d.date) as day,
                DATE_FORMAT(d.date, '%b %d, %Y') as att_date,

                des.name AS designation,
                dep.name AS department,
                
                a.id,
                a.in_time,  
                a.out_time,  
                a.status_id,

                TIME_FORMAT(
                    TIMEDIFF(a.out_time, a.in_time),
                    '%H:%i'
                ) AS duration,
                
                c.leave_calendar_id,
                c.holiday,
                c.flexible_day,
                c.description,
                '' status

            FROM employees e

            CROSS JOIN dates d

            -- attendance join
            LEFT JOIN attendances a 
                ON a.employee_id = e.id
                AND DATE(a.date) = d.date

            -- designation join
            LEFT JOIN parameters des 
                ON des.id = e.designation_id

            -- department join
            LEFT JOIN parameters dep 
                ON dep.id = e.department_id
                
            LEFT JOIN leave_calendar_details c 
                ON c.leave_calendar_id  = e.calendar_id
                and d.date = date(c.date)
            ORDER BY e.id, d.date) as t;

            END       
            ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_select_attendance");
    }
};
