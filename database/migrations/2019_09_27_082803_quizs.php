<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Quizs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizs', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('quiz_title', 250)->nullable();
            $table->integer('quiz_no');
            $table->integer('quiz_posted_by');
            $table->boolean('quiz_status')->default(1)->comment('1 for  active, 2 for inactive');
            $table->dateTime('quiz_created_at')->nullable();
            $table->dateTime('quiz_updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('quizs');
    }
}
