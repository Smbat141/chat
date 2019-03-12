<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_comment', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('room_id')->unsigned()->default(1);
            $table->foreign('room_id')->references('id')->on('rooms');

            $table->integer('comment_id')->unsigned()->default(1);
            $table->foreign('comment_id')->references('id')->on('comments');

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
        Schema::dropIfExists('room_comment');
    }
}
