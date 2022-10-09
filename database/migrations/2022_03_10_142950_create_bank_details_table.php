<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateBankDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_details', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::insert('insert into bank_details (id, bank_name) values (?, ?)', [1, 'ธนาคารกรุงเทพ']);
        DB::insert('insert into bank_details (id, bank_name) values (?, ?)', [2, 'ธนาคารกสิกรไทย']);
        DB::insert('insert into bank_details (id, bank_name) values (?, ?)', [3, 'ธนาคารกรุงไทย']);
        DB::insert('insert into bank_details (id, bank_name) values (?, ?)', [4, 'ธนาคารทหารไทยธนชาต']);
        DB::insert('insert into bank_details (id, bank_name) values (?, ?)', [5, 'ธนาคารไทยพาณิชย์']);
        DB::insert('insert into bank_details (id, bank_name) values (?, ?)', [6, 'ธนาคารกรุงศรีอยุธยา']);
        DB::insert('insert into bank_details (id, bank_name) values (?, ?)', [7, 'ธนาคารเกียรตินาคินภัทร']);
        DB::insert('insert into bank_details (id, bank_name) values (?, ?)', [8, 'ธนาคารซีไอเอ็มบีไทย']);
        DB::insert('insert into bank_details (id, bank_name) values (?, ?)', [9, 'ธนาคารทิสโก้']);
        DB::insert('insert into bank_details (id, bank_name) values (?, ?)', [10, 'ธนาคารยูโอบี']);
        DB::insert('insert into bank_details (id, bank_name) values (?, ?)', [11, 'ธนาคารไทยเครดิตเพื่อรายย่อย']);
        DB::insert('insert into bank_details (id, bank_name) values (?, ?)', [12, 'ธนาคารแลนด์ แอนด์ เฮ้าส์']);
        DB::insert('insert into bank_details (id, bank_name) values (?, ?)', [13, 'ธนาคารออมสิน']);
        DB::insert('insert into bank_details (id, bank_name) values (?, ?)', [14, 'ธนาคารอาคารสงเคราะห์']);
        DB::insert('insert into bank_details (id, bank_name) values (?, ?)', [15, 'ธนาคารอิสลามแห่งประเทศไทย']);
        DB::insert('insert into bank_details (id, bank_name) values (?, ?)', [16, 'ธนาคารเพื่อการเกษตรและสหกรณ์การเกษตร']);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_details');
    }
}
