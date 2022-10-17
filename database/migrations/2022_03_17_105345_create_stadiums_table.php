<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateStadiumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stadiums', function (Blueprint $table) {
            $table->id();
            $table->string('stadium_name');
            $table->float('stadium_price');
            $table->string('stadium_detail');
            $table->char('del',1)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("ALTER TABLE stadiums ADD stadium_img MEDIUMBLOB");

        DB::insert('insert into stadiums (id, stadium_name,stadium_price,stadium_detail,del)
        values (?, ?, ?, ? ,?)', [1, 'Stadium 1 (INDOOR)',1000,'Soccer Cube สนามฟุตบอลหญ้าเทียมให้เช่า ในร่ม และกลางแจ้ง กังสดาล หลังวัดป่าอดุลยาราม ใกล้มหาวิทยาลัยขอนแก่น ตำบลในเมือง อำเภอเมืองขอนแก่น ขอนแก่น 40000',NULL]);

        DB::insert('insert into stadiums (id, stadium_name,stadium_price,stadium_detail,del)
        values (?, ?, ?, ? ,?)', [2, 'Stadium 2 (OUTDOOR)',800,'Soccer Cube สนามฟุตบอลหญ้าเทียมให้เช่า ในร่ม และกลางแจ้ง กังสดาล หลังวัดป่าอดุลยาราม ใกล้มหาวิทยาลัยขอนแก่น ตำบลในเมือง อำเภอเมืองขอนแก่น ขอนแก่น 40000',NULL]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stadium');
    }
}
