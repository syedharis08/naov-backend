<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInquiryForwarderContainerRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquiry_forwarder_container_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inquiry_forwarder_rate_id');
            $table->foreignId('container_id');
            $table->string('num_of_containers');
            $table->string('exw_charge')->nullable();
            $table->string('rate')->nullable();
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
        Schema::dropIfExists('inquiry_forwarder_container_rates');
    }
}
