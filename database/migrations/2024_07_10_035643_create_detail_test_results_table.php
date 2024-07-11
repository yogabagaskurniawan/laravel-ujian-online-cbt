<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_test_results', function (Blueprint $table) {
            $table->id();
            $table->integer('test_result_id');
            $table->string('uid');
            $table->enum('status',['not_started','fail', 'succeed'])->default('not_started');
            $table->integer('correctAnswers')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_test_results');
    }
};
