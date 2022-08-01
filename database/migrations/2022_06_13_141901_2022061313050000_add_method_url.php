<?php

use App\Enum\MethodEnum;
use App\Enum\ServiceTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('urls', function (Blueprint $table) {
            $table->string('method')->default(MethodEnum::POST->value)->after('headers');
            $table->string('service_type')->default(ServiceTypeEnum::SOAP->value)->after('method');
        });
    }

    public function down()
    {
        Schema::table('urls', function (Blueprint $table) {
            $table->dropColumn('method');
            $table->dropColumn('service_type');
        });
    }
};
