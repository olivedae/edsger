<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRouteSharesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_shares', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_from_id')->unsigned();
            $table->integer('user_to_id')->unsigned();
            $table->integer('route_id')->unsigned();
            $table->foreign('user_from_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            $table->foreign('user_to_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            $table->foreign('route_id')
                  ->references('id')->on('routes')
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
        Schema::drop('route_shares');
    }
}
