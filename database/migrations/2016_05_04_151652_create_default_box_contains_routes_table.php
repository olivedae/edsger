<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefaultBoxContainsRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('default_box_contains_routes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('default_box_id')->unsigned();
            $table->integer('route_id')->unsigned();
            $table->foreign('default_box_id')
                  ->references('id')->on('default_boxes')
                  ->onDelete('cascade');
            $table->foreign('route_id')
                  ->references('id')->on('routes')
                  ->onDelete('cascade');
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
        Schema::drop('default_box_contains_routes');
    }
}
