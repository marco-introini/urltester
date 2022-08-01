<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BugfixTestsTable extends Migration
{
    public function up()
    {
        Schema::table('tests', function (Blueprint $table) {
            $table->dropColumn('expected_response');
        });
        Schema::table('tests', function (Blueprint $table) {
            $table->text('expected_response')->nullable();
        });
    }

    public function down()
    {
        Schema::table('tests', function (Blueprint $table) {
            $table->dropColumn('expected_response');
        });
        Schema::table('tests', function (Blueprint $table) {
            $table->boolean('expected_response')->nullable();
        });
    }
}
