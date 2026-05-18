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
        Schema::create('bank_operators', function (Blueprint $table) {
            $table->id();
            $table->integer('type_id'); // 1 for bank, 2 for operator   
            $table->string('name');
            $table->tinyInteger('inactive')->default(0); // 0 = active, 1 = inactive
            $table->timestamps();
        });

        DB::table('bank_operators')->insert([
            ['id'=>1, 'type_id'=>27, 'name'=>'Maybank2u / MAE app','created_at'=>null,'updated_at'=>null,'inactive'=>0],
            ['id'=>2, 'type_id'=>27, 'name'=>'CIMB OCTO app','created_at'=>null,'updated_at'=>null,'inactive'=>0],
            ['id'=>3, 'type_id'=>27, 'name'=>'PB engage / PBe app','created_at'=>null,'updated_at'=>null,'inactive'=>0],
            ['id'=>4, 'type_id'=>27, 'name'=>'RHB Mobile Banking app','created_at'=>null,'updated_at'=>null,'inactive'=>0],
            ['id'=>5, 'type_id'=>27, 'name'=>'HLB Connect app','created_at'=>null,'updated_at'=>null,'inactive'=>0],


            ['id'=>6, 'type_id'=>28,'name'=>'Maybank', 'created_at'=>null,'updated_at'=>null,'inactive'=>0],
            ['id'=>7, 'type_id'=>28,'name'=>'CIMB Group', 'created_at'=>null,'updated_at'=>null,'inactive'=>0],
            ['id'=>8, 'type_id'=>28,'name'=>'Public Bank', 'created_at'=>null,'updated_at'=>null,'inactive'=>0],
            ['id'=>9, 'type_id'=>28,'name'=>'RHB Bank', 'created_at'=>null,'updated_at'=>null,'inactive'=>0],
            ['id'=>10, 'type_id'=>28,'name'=>'Hong Leong Bank', 'created_at'=>null,'updated_at'=>null,'inactive'=>0]
 
        ]);



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_operators');
    }
};
 