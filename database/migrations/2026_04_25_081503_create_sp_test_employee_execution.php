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
        
            DROP PROCEDURE IF EXISTS sp_test_employee_execution;
            CREATE PROCEDURE sp_test_employee_execution()
            BEGIN
                DECLARE i INT DEFAULT 1;
                DECLARE dept_min INT;
                DECLARE dept_max INT;
                DECLARE desig_min INT;
                DECLARE desig_max INT;
                

                truncate employees;

                WHILE i <= 150 DO
                
                    INSERT INTO employees (
                        name,
                        phone,
                        email,
                        code,
                        department_id,
                        designation_id,
                        joining_date
                    )
                    VALUES (
                        CONCAT(
                            ELT(FLOOR(1 + RAND() * 5), 'Alice', 'Bob', 'Charlie', 'Diana', 'Eve'),
                            ' ',
                            ELT(FLOOR(1 + RAND() * 5), 'Smith', 'Johnson', 'Brown', 'Davis', 'Miller')
                        ),

                        CONCAT(
                            '01',
                            ELT(FLOOR(1 + RAND() * 7), '1','2','3','4','6','7','8'),
                            LPAD(FLOOR(RAND() * 10000000), 7, '0')
                        ),

                        CONCAT(
                            LOWER(ELT(FLOOR(1 + RAND() * 5), 'Alice','Bob','Charlie','Diana','Eve')),
                            FLOOR(1 + RAND() * 1000),
                            '@example.com'
                        ),

                        (SELECT fnc_get_code(0)),

                        FLOOR(1 + RAND() * 5),   -- department_id (1–5)

                        FLOOR(6 + RAND() * 6),   -- designation_id (6–11)

                        DATE_SUB(
                            CURDATE(),
                            INTERVAL FLOOR(RAND() * 7300) DAY
                        ) -- joining_date (last ~20 years)
                    );
                    
                    SET i = i + 1;
                END WHILE;
            END
        
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_test_employee_execution");
    }
};
