<?php

use App\Models\Url;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('load_tests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(Url::class);
            $table->bigInteger('number_requests')->nullable();
            $table->bigInteger('concurrent_requests')->nullable();
            $table->bigInteger('number_requests_effective')->nullable();
            $table->bigInteger('success_number')->nullable();
            $table->bigInteger('failure_number')->nullable();
            $table->json('failure_responses')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('load_tests');
    }
};
