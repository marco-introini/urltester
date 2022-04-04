<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUrlsTable extends Migration
{
    public function up()
    {
        Schema::create('urls', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url');
            $table->json('headers')->nullable();
            $table->text('request');
            $table->text('expected_response')->nullable();
            $table->foreignId('certificate_id')->nullable();
            $table->foreign('certificate_id')->on('certificates')->references('id')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('urls');
    }
}