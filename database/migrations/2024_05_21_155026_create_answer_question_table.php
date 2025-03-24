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
        Schema::create('answer_question', function (Blueprint $table) {
            
            //generic table for displaying answers
            $table->id();
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('answer_id');
            // $table->boolean('is_right');
            $table->timestamps();
        });

        Schema::table('answer_question', function (Blueprint $table) {
            $table->foreign('question_id')->references('id')->on('questions');
            $table->foreign('answer_id')->references('id')->on('answers');
        });

        // Schema::table('users', function (Blueprint $table) {
        //     $table->timestamp('created_at', 3)->nullable();
        //     $table->timestamp('updated_at', 3)->nullable();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answer_question');
    }
};
