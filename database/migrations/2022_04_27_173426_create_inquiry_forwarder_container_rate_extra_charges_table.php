<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInquiryForwarderContainerRateExtraChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquiry_forwarder_container_rate_extra_charges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inquiry_forwarder_container_rate_id');
            $table->string('name')->nullable();
            $table->double('rate')->nullable();
            $table->timestamps();
            $table->foreign('inquiry_forwarder_container_rate_id', 'container_rate_id_index')->references('id')->on('inquiry_forwarder_container_rates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inquiry_forwarder_container_rate_extra_charges');
    }
}
