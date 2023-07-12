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
        Schema::create('stages', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('end_of_internship_certificate');
            $table->foreignId('company_id');
            $table->string('rapport');
            $table->unsignedBigInteger('etudiant_id');
            $table->unsignedBigInteger('encadrant_id');
            $table->string('journal');
            $table->boolean('affected');
            $table->string('letter');
            $table->date('dateD_stage');
            $table->date('dateF_stage');
            $table->date('dateS');
            $table->timestamps();
        });
        Schema::create('stages', function (Blueprint $table) {
            $table->foreign('etudiant_id')->references('id')->on('users');
            $table->foreign('encadrant_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stages');
    }
};
