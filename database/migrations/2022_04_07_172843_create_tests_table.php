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
            $table->foreign('url_id')->on('urls')->references('id')->cascadeOnDelete();
            $table->string('called_url');
            $table->text('request')->nullable();
            $table->timestamp('request_date')->nullable();
            $table->text('response')->nullable();
            $table->boolean('expected_response')->nullable();
            $table->timestamp('response_date')->nullable();
            $table->bigInteger('response_time')->nullable();
            $table->boolean('response_ok')->default(true);
            $table->text('curl_info')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tests');
    }
}
