<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Quizs;
use App\QuizQuestionAnswers;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use DB;
use Session;

class QuizController extends Controller
{
    public function index()
    {
        $data['active'] = 'Quiz';
        $data['sub_active'] = '';
        $data['sub_active1'] = '';
        $data['quiz'] = Quizs::All();
        return view("admin.quiz", $data);
    }

    public function postquiz(Request $request){
    	
    	$record['active'] = 'Quiz';
        $record['sub_active'] = '';
        $record['sub_active1'] = '';
    	return view("admin.postquiz",$record);
    }

    public function create_quiz(Request $request){
    	
    	$record['active'] = 'Quiz';
        $record['sub_active'] = '';
        $record['sub_active1'] = '';

        $Validator = Validator::make($request->all(),[
    		"title" => "required|string",
    		'question.*' => 'required|string',
    		'option_1.*' => 'required|string',
    		'option_2.*' => 'required|string',
    		'option_3.*' => 'required|string',
    		'option_4.*' => 'required|string',
    		'right_option.*' => 'required|string',
    		'right_opt_reason.*' => 'required|string',
    	]);

    	if($Validator->fails()){
    		return redirect()->back()->withErrors($Validator)->withInput();
    		//return redirect()->back()->with("error_message",$Validator->messages()->first());
    	}
    	$quizno = $this->custom_rand_no('quizs', 1890);
    	$quizArray = array(
    		'quiz_title' => $request->title,
    		'quiz_no' => $quizno,
    		'quiz_posted_by' => Auth::guard('admin')->user()->id,
    		'quiz_status' => 1,
    		'created_at' => date('Y-m-d h:i:s')
    	);
    	$quizid  = DB::table('quizs')->insertGetId($quizArray);
    	if(@$quizid){
    		$quiz_question = $request->question;
		    	foreach ($quiz_question as $key => $value) {
		    		$order_no = $key + 1;
		    		$fieldArray[] = array(
		    			'quiz_id' => @$quizid,
		    			'question' => @$value,
		    			'option_one' => @$request->option_1[$key],
		    			'option_two' => @$request->option_2[$key],
		    			'option_three' => @$request->option_3[$key],
		    			'option_four' => @$request->option_4[$key],
		    			'right_option' => @$request->right_option[$key],
		    			'reason_of_right_option' => @$request->right_opt_reason[$key],
		    			'order_no' => @$order_no,
		    			'status' => 1,
		    			'created_at' => date('Y-m-d h:i:s')
		    		);
		    	}
		    QuizQuestionAnswers::insert($fieldArray);
    	}
    	
       return redirect('admin/quiz')->with("message","Quiz has been added successfully.");
    }
    /*
	 * Function for delete quiz
 	 */
 	public function delete_quiz($id){

 		if(DB::table('quiz_question_answers')->where('quiz_id','=',$id)->delete()){
 			DB::table('quizs')->where('id','=',$id)->delete();
 		}
		
 		return redirect()->back()->with("message","Quiz has been deleted successfully.");
 	}
 	/*
	 * Function for generate custom_rand_no
 	 */
    public function custom_rand_no($table, $countwith=1890){
    	$getres = DB::table($table)->select('id')->latest()->first();
    	$param1 = 0;
    	if(!empty(@$getres)){
    		$param1 = @$getres->id;
    	}
    	$param2 = intval($countwith) + intval($param1);
    	$rand_no = 'FMU_'.rand(0,999).$param2;
    	return $rand_no;
    }
}
