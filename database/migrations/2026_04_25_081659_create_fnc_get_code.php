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
       
                DROP FUNCTION IF EXISTS fnc_get_code;
                CREATE FUNCTION fnc_get_code(type_id INT) RETURNS varchar(20) CHARSET utf8mb4
                    DETERMINISTIC
                BEGIN
                    DECLARE v_ID VARCHAR(20) DEFAULT '';
                    DECLARE v_pid INT DEFAULT 0;
                    DECLARE v_psnt_id VARCHAR(20) DEFAULT '';
                    DECLARE v_cyear VARCHAR(2);
                    DECLARE v_cmonth VARCHAR(2);
                    DECLARE v_pyear VARCHAR(2);
                    DECLARE v_pmonth VARCHAR(2);

                    IF (type_id = 0) THEN
                        SET v_ID = 'EMP-';
                        SELECT IFNULL(code, '') INTO v_psnt_id FROM employees ORDER BY id DESC LIMIT 1;
                    ELSEIF (type_id = 1) THEN
                        SET v_ID = 'CLI-';
                        SELECT IFNULL(code, '') INTO v_psnt_id FROM clients ORDER BY id DESC LIMIT 1;
                    ELSEIF (type_id = 2) THEN
                        SET v_ID = 'APP-';
                        SELECT IFNULL(code, '') INTO v_psnt_id FROM appointments ORDER BY id DESC LIMIT 1;
                    END IF;

                    SET v_cyear = DATE_FORMAT(NOW(), '%y');
                    SET v_cmonth = DATE_FORMAT(NOW(), '%m');

                    IF (v_psnt_id = '') THEN
                        SET v_ID = CONCAT(v_ID, v_cmonth, v_cyear, '-001');
                    ELSE
                        SET v_pyear = SUBSTRING(v_psnt_id, 7, 2);
                        SET v_pmonth = SUBSTRING(v_psnt_id, 5, 2);

                        IF (v_cyear = v_pyear AND v_cmonth = v_pmonth) THEN
                            SET v_pid = CAST(SUBSTRING(v_psnt_id, 10, 3) AS UNSIGNED) + 1;
                            SET v_ID = CONCAT(v_ID, v_cmonth, v_cyear, '-', LPAD(v_pid, 3, '0'));
                        ELSE
                            SET v_ID = CONCAT(v_ID, v_cmonth, v_cyear, '-001');
                        END IF;
                    END IF;

                    RETURN v_ID;
                END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP FUNCTION IF EXISTS fnc_get_code");
    }
};
