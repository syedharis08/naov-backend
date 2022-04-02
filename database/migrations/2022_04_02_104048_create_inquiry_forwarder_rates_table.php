<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInquiryForwarderRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquiry_forwarder_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inquiry_id');
            $table->foreignId('forwarder_id');
            $table->foreignId('carrier_id');
            $table->string('validity_rate')->nullable();
            $table->string('free_days')->nullable();
            $table->string('closing_date')->nullable();
            $table->string('vessel_departure')->nullable();
            $table->string('ship_transit_time')->nullable();
            $table->string('vessel_arrival')->nullable();
            $table->string('rate')->nullable();
            $table->string('via_ports')->nullable();
            $table->boolean('is_direct_route')->default(0);
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('inquiry_forwarder_rates');
    }
}
