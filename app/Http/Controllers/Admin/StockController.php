<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\StockPicks;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use DB;
use Session;

class StockController extends Controller
{
    public function index()
    {
        $data['active'] = 'Post';
        $data['sub_active'] = 'Stock';
        $data['sub_active1'] = '';
        $data['stock'] = StockPicks::latest()->get();
        return view("admin.stockpick", $data);
    }

     /*******************************************
	 * Function for post New Stock 
 	 *******************************************/
    public function poststock(Request $request){
    	
    	$data['active'] = 'Post';
        $data['sub_active'] = 'Stock';
        $data['sub_active1'] = '';
        $data['stock_ctg'] = __('finmeup_leng.stock_category');
    	return view("admin.poststock",$data);
    }

     /*******************************************
	 * Function for add new stock pick
 	 *******************************************/
    public function create_stock(Request $request){
    	
    	$record['active'] = 'Post';
        $record['sub_active'] = 'Stock';
        $record['sub_active1'] = '';

        $Validator = Validator::make($request->all(),[
    		"category" => "required",
    		'stock_name' => 'required|string',
    		'current_market_price' => 'required',
    		'target_price' => 'required',
    		'description' => 'required',
    		'listed_in' => 'required',
    		'reason' => 'required',
    		'hold_for_year' => 'required_if:category,3',
    		'hold_for_month' => 'required_if:category,3',
    		'hold_for_days' => 'required_if:category,3',
    	]);
       
    	if($Validator->fails()){
    		return redirect()->back()->withErrors($Validator)->withInput();
    		//return redirect()->back()->with("error_message",$Validator->messages()->first());
    	}
    	$image_path = "";
    	$file = $request->file('image');
        if(@$file){
            $file_array = ['jpg','jpeg','png'];
            $filetype = $file->getClientOriginalExtension();
            if(!in_array($filetype, $file_array)){
            return redirect()->back()->with("error_message","Please upload valid image, which support this format - jpg, jpeg, png.");
            }
            $imagename = 'st_'.rand(0,9999).strtotime('now').'.'.$filetype;
            $destinationPath = 'storage/images/stockimage/';
            $image_path = $destinationPath.$imagename;
            $file->move($destinationPath,$imagename);
        }
    	$fieldArray = array(
    		'category' => @$request->category,
    		'stock_name' => @$request->stock_name,
    		'description' => @$request->description,
    		'listed_in' => @$request->listed_in,
    		'current_market_price' => @$request->current_market_price,
    		'target_price' => @$request->target_price,
    		'hold_for_days' => (@$request->hold_for_days ? @$request->hold_for_days : 0),
    		'hold_for_month' => (@$request->hold_for_month ? @$request->hold_for_month : 0),
    		'hold_for_year' => (@$request->hold_for_year ? @$request->hold_for_year : 0),
    		'image' => @$image_path,
    		'reason' => @$request->reason,
    		'status' => 1,
    		'created_at' => date('Y-m-d h:i:s')
    	);
    	$stockid  = DB::table('stock_picks')->insertGetId($fieldArray);
		return redirect('admin/stockpicks')->with("message","StockPick has been added successfully.");
    }
    /*******************************************
	 * Function for edit stock
 	 *******************************************/
 	public function edit_stock($id){
 		$data['active'] = 'Post';
        $data['sub_active'] = 'Stock';
        $data['sub_active1'] = '';
        $data['stock_ctg'] = __('finmeup_leng.stock_category');
        $data['stock'] =  StockPicks::where('id', $id)->first();
        return view("admin.editstock",$data);
 	}

 	/*******************************************
	 * Function for update stock
 	 *******************************************/
    public function update_stock(Request $request){
    	
    	$record['active'] = 'Post';
        $record['sub_active'] = 'Stock';
        $record['sub_active1'] = '';

        $Validator = Validator::make($request->all(),[
    		"category" => "required",
    		'stock_name' => 'required|string',
    		'current_market_price' => 'required',
    		'target_price' => 'required',
    		'description' => 'required',
    		'listed_in' => 'required',
    		'reason' => 'required',
    		'hold_for_year' => 'required_if:category,3',
    		'hold_for_month' => 'required_if:category,3',
    		'hold_for_days' => 'required_if:category,3',
    	]);
       
    	if($Validator->fails()){
    		return redirect()->back()->withErrors($Validator)->withInput();
    		//return redirect()->back()->with("error_message",$Validator->messages()->first());
    	}
    	$image_path = "";
    	$file = $request->file('image');
        if(@$file){
            $file_array = ['jpg','jpeg','png'];
            $filetype = $file->getClientOriginalExtension();
            if(!in_array($filetype, $file_array)){
            return redirect()->back()->with("error_message","Please upload valid image, which support this format - jpg, jpeg, png.");
            }
            $imagename = 'st_'.rand(0,9999).strtotime('now').'.'.$filetype;
            $destinationPath = 'storage/images/stockimage/';
            $image_path = $destinationPath.$imagename;
        	$existingimagepath = $request->stock_image;
            if($file->move($destinationPath,$imagename)){
            	 if(File::exists($existingimagepath)) {
		                File::delete($existingimagepath);
		            }
            }
        }else{
        	$image_path = $request->stock_image;
        }
    	$fieldArray = array(
    		'category' => @$request->category,
    		'stock_name' => @$request->stock_name,
    		'description' => @$request->description,
    		'listed_in' => @$request->listed_in,
    		'current_market_price' => @$request->current_market_price,
    		'target_price' => @$request->target_price,
    		'hold_for_days' => (@$request->hold_for_days ? @$request->hold_for_days : 0),
    		'hold_for_month' => (@$request->hold_for_month ? @$request->hold_for_month : 0),
    		'hold_for_year' => (@$request->hold_for_year ? @$request->hold_for_year : 0),
    		'image' => @$image_path,
    		'reason' => @$request->reason,
    		'updated_at' => date('Y-m-d h:i:s')
    	);
    	DB::table('stock_picks')->where('id',$request->stock_id)->update($fieldArray);
		return redirect('admin/stockpicks')->with("message","StockPick has been updated successfully.");
    }

   	/*******************************************
	 * Function for delete stock
 	 *******************************************/
    public function delete_stock($id){
    	DB::table('stock_picks')->where('id','=',$id)->delete();
 		return redirect()->back()->with("message","Stock Pick has been deleted successfully.");
    }
    
     /******************************************
	 * Function for > changes_quiz_status
 	 ******************************************/
    public function change_stock_status($id,$status){
    	$editArray = array(
    		'status' => $status
    	);
    	DB::table('stock_picks')->where('id','=',$id)->update($editArray);
    	return redirect()->back()->with("message","Status has been updated successfully.");
    }
}
