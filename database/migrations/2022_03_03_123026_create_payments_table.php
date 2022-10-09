<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_status');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::insert('insert into payments (id, payment_status) values (?, ?)', [1, 'payment completed']);
        DB::insert('insert into payments (id, payment_status) values (?, ?)', [2, 'Waiting to confirmed payment']);
        DB::insert('insert into payments (id, payment_status) values (?, ?)', [3, 'Waiting to refund']);
        DB::insert('insert into payments (id, payment_status) values (?, ?)', [4, 'Refund complete']);
        DB::insert('insert into payments (id, payment_status) values (?, ?)', [5, 'Waiting to pay']);
        DB::insert('insert into payments (id, payment_status) values (?, ?)', [6, 'Cancel complete']);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
