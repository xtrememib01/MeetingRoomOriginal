<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('conference_details');
            $table->date('date');
            $table->time('startTime');
            $table->time('endTime');
            //this is used to for passing an array as a string; casting method, reference in BookROOM
            //$table->string('shifts')->nullable();
            $table->string('shifts');
            $table->text('agenda');
            $table->integer('user_id')->nullable();
            $table->char('status')->nullable();
            $table->char('platform')->nullable();
            $table->text('url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_rooms');
    }
}
