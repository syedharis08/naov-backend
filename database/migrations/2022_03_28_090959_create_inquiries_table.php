<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('service_id');
            $table->foreignId('forwarder_id')->nullable();
            $table->foreignId('shipper_id')->nullable();
            $table->string('company_inquiry_id')->nullable();
            $table->string('volume')->nullable();
            $table->string('commodity')->nullable();
            $table->string('weight')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_dangerous')->default(0);
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
        Schema::dropIfExists('inquiries');
    }
}
