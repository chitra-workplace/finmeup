<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QuizQuestionAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_question_answers', function(Blueprint $table)
        {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('quiz_id')->nullable();
            $table->foreign('quiz_id')->references('id')->on('quizs')->comment('refer from table quiz');

            $table->text('question', 1000)->nullable();
            $table->string('option_one', 500)->nullable();
            $table->string('option_two', 500)->nullable();
            $table->string('option_three', 500)->nullable();
            $table->string('option_four', 500)->nullable();
            $table->string('option_five', 500)->nullable();
            $table->string('right_option', 500)->nullable();
            $table->string('reason_of_right_option', 500)->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('quiz_question_answers');
    }
}
