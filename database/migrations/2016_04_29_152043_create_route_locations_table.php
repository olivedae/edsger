<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRouteLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('route_id')->unsigned();
            $table->integer('location_id')->unsigned();
            $table->foreign('route_id')
                  ->references('id')->on('routes')
                  ->onDelete('cascade');
            $table->foreign('location_id')
                  ->references('id')->on('locations')
                  ->onDelete('cascade');
            $table->integer('previous_index')->unsigned();
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
        Schema::drop('route_locations');
    }
}
