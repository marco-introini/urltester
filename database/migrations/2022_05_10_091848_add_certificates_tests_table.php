<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCertificatesTestsTable extends Migration
{
    public function up()
    {
        Schema::table('tests', function (Blueprint $table) {
            $table->text('request_headers')->nullable();
            $table->text('certificates_used')->nullable();
        });
    }

    public function down()
    {
        Schema::table('tests', function (Blueprint $table) {
            $table->removeColumn('request_headers');
            $table->removeColumn('certificates_used');
        });
    }
}
