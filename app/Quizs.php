<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quizs extends Model
{
    public function quiz_qus_ans(){
        return $this->hasMany("App\QuizQuestionAnswers","quiz_id","id");
    }
}
