<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateReservesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('payment_id')->references('id')->on('payments')->onDelete('cascade');
            $table->foreignId('stadium_id')->references('id')->on('stadiums')->onDelete('cascade');
            $table->float('total_price');
            $table->float('total_price_discount')->nullable();
            $table->float('total_point_discount')->nullable();
            $table->float('total_add_point')->nullable();
            $table->date('reserve_date');
            $table->time('time_start');
            $table->time('time_end');
            $table->timestamps();
            $table->softDeletes();
        });
        
        DB::statement("ALTER TABLE reserves ADD slip_img MEDIUMBLOB");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserves');
    }
}
