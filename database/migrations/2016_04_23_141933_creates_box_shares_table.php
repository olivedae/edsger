<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatesBoxSharesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('box_shares', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_from_id')->unsigned();
            $table->integer('user_to_id')->unsigned();
            $table->integer('box_id')->unsigned();
            $table->foreign('user_from_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            $table->foreign('user_to_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            $table->foreign('box_id')
                   ->references('id')->on('boxes')
                   ->onDelete('cascade');
            $table->boolean('accepted')->default(false);
            $table->boolean('pending')->default(true);
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
        Schema::drop('box_shares');
    }
}
