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
        Schema::create('juries', function (Blueprint $table) {
            $table->unsignedBigInteger('stage_id');
            $table->unsignedBigInteger('encadrant_id');
            $table->timestamps();

            // Define other columns here

            $table->foreign('stage_id')->references('id')->on('stages');
            $table->foreign('encadrant_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('juries');
    }
};
