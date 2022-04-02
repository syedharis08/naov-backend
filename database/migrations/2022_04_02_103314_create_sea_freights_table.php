<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeaFreightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sea_freights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inquiry_id');
            $table->foreignId('container_id');
            $table->foreignId('shipper_id')->nullable();
            $table->foreignId('loading_port')->nullable();
            $table->foreignId('destination_port')->nullable();
            $table->integer('sea_freight_type')->nullable();
            $table->string('date')->nullable();
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
        Schema::dropIfExists('sea_freights');
    }
}
