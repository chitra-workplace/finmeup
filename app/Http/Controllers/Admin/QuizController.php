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
        $data['active'] = 'Post';
        $data['sub_active'] = 'Quiz';
        $data['sub_active1'] = '';
        $data['quiz'] = Quizs::With('quiz_qus_ans')->latest()->get();
        return view("admin.quiz", $data);
    }
     /*******************************************
	 * Function for show view for create new quiz
 	 *******************************************/
    public function postquiz(Request $request){
    	
    	$data['active'] = 'Post';
        $data['sub_active'] = 'Quiz';
        $data['sub_active1'] = '';
    	return view("admin.postquiz",$data);
    }
     /*******************************************
	 * Function for add new quiz
 	 *******************************************/
    public function create_quiz(Request $request){
    	
    	$record['active'] = 'Post';
        $record['sub_active'] = 'Quiz';
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
     /*******************************************
	 * Function for edit quiz
 	 *******************************************/
 	public function edit_quiz($id){
 		$data['active'] = 'Post';
        $data['sub_active'] = 'Quiz';
        $data['sub_active1'] = '';
        $data['quiz'] =  Quizs::With('quiz_qus_ans')->where('id', $id)->first();
        return view("admin.editquiz",$data);
 	}
 	 /******************************************
	 * Function for > update_quiz
 	 ******************************************/
    public function update_quiz(Request $request){
   
    	$Validator = Validator::make($request->all(),[
    	 	"quiz_id"=>"required",
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
    		'updated_at' => date('Y-m-d h:i:s')
    	);
    	$quizid  = DB::table('quizs')->where('id',$request->quiz_id)->update($quizArray);
    	if(@$quizid){
    		$order_no = 0;
    		$quiz_question = @$request->question;
    		if(!empty($quiz_question)){
    			foreach ($quiz_question as $key => $value) {
    				//echo 'q_ans_id'.@$request->q_ans_id[$key]."<br>";
    				if(@$request->q_ans_id[$key] AND !empty(@$request->q_ans_id[$key])){
    					$order_no++;
			    		$editfieldArray = array(
			    			'question' => @$request->question[$key],
			    			'option_one' => @$request->option_1[$key],
			    			'option_two' => @$request->option_2[$key],
			    			'option_three' => @$request->option_3[$key],
			    			'option_four' => @$request->option_4[$key],
			    			'right_option' => @$request->right_option[$key],
			    			'reason_of_right_option' => @$request->right_opt_reason[$key],
			    			'updated_at' => date('Y-m-d h:i:s')
			    		);
			    		DB::table('quiz_question_answers')->where('id',$request->q_ans_id[$key])->update($editfieldArray);
    				}else{
    					$order_no = $order_no + 1;
			    		$fieldArray = array(
			    			'quiz_id' => @$request->quiz_id,
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
			    		QuizQuestionAnswers::insert($fieldArray);
    				}
		    		
		    	};
				  
    		}
    	
    	}
        return redirect('admin/edit_quiz/'.@$request->quiz_id)->with("message","Quiz has been updated successfully.");
    }

    /******************************************
	 * Function for > changes_quiz_status
 	 ******************************************/
    public function changes_quiz_status($id,$status){
    	$editArray = array(
    		'quiz_status' => $status
    	);
    	DB::table('quizs')->where('id','=',$id)->update($editArray);
    	return redirect()->back()->with("message","Status has been updated successfully.");
    }

     /*******************************************
	 * Function for delete quiz > question_answers
 	 *******************************************/
    public function remove_quiz_qus($id){
    	$code = 300;
    	if(DB::table('quiz_question_answers')->where('id','=',$id)->delete()){
    		$code = 200;
    	}
    	echo json_encode(array('code' => $code));
    }
    /*******************************************
	 * Function for delete quiz
 	 *******************************************/
 	public function delete_quiz($id){

 		// if(DB::table('quiz_question_answers')->where('quiz_id','=',$id)->delete()){
 		// 	DB::table('quizs')->where('id','=',$id)->delete();
 		// }
 		DB::table('quiz_question_answers')->where('quiz_id','=',$id)->delete();
		DB::table('quizs')->where('id','=',$id)->delete();
 		return redirect()->back()->with("message","Quiz has been deleted successfully.");
 	}
 	/*******************************************
	 * Function for generate custom_rand_no
 	 *******************************************/
    public function custom_rand_no($table, $countwith=1890){
    	$getres = DB::table($table)->select('id')->latest()->first();
    	$param1 = 0;
    	if(!empty(@$getres)){
    		$param1 = @$getres->id;
    	}
    	$param2 = intval($countwith) + intval($param1);
    	$rand_no = 'QZ_'.rand(0,999).$param2;
    	return $rand_no;
    }
}
