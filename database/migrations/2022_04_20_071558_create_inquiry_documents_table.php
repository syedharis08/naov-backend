<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInquiryDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquiry_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inquiry_id');
            $table->foreignId('user_id');
            $table->string('document_path');
            $table->integer('document_type');
            $table->string('document_name')->nullable();
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
        Schema::dropIfExists('inquiry_documents');
    }
}
