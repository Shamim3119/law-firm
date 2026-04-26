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
                DROP PROCEDURE IF EXISTS sp_test_client_execution;
                CREATE  PROCEDURE sp_test_client_execution()
                BEGIN
                    DECLARE i INT DEFAULT 1;
                    DECLARE dept_min INT;
                    DECLARE dept_max INT;
                    DECLARE desig_min INT;
                    DECLARE desig_max INT;
                    

                    truncate clients;

                    WHILE i <= 150 DO
                        INSERT INTO clients (name, phone, email, code)
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
                            (select fnc_get_code(1))
                        );
                        SET i = i + 1;
                    END WHILE;

                    select 'Execution success';

                END
        
        
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_test_client_execution");
    }
};
