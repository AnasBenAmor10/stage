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
        Schema::create('stage_encadrants', function (Blueprint $table) {
            $table->unsignedBigInteger('encadrant_id');
            $table->unsignedBigInteger('stage_id');
            $table->timestamps();

            $table->foreign('stage_id')->references('id')->on('stages');
            $table->foreign('encadrant_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stage_encadrants');
    }
};
