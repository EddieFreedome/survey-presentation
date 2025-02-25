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
        // Il nome si riferisce al model Savesessionline!!
        Schema::create('savesessionlines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); //how to implement it?
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('answer_id')->nullable(); //there will be multiple rows in the same table
            $table->datetime('time_of_answering')->nullable();//datetime of answering
            $table->timestamps(3);
        });

        
        Schema::table('savesessionlines', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('question_id')->references('id')->on('questions');
            $table->foreign('answer_id')->references('id')->on('answers');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('savesessionlines');
    }
};
