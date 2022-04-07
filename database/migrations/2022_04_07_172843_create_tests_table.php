<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('url_id');
            $table->foreign('url_id')->on('url')->references('id')->cascadeOnDelete();
            $table->text('request')->nullable();
            $table->dateTime('request_date')->nullable();
            $table->text('response')->nullable();
            $table->dateTime('response_date')->nullable();
            $table->bigInteger('response_time')->nullable();
            $table->boolean('response_ok')->default(true);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tests');
    }
}