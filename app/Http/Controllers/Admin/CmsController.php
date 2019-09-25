<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use App\Cms;
use App\Aboutus;
use Validator;

class CmsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
  

    public function term_condition(){
        $record['active'] = 'Terms_Condition';
        $record['sub_active'] = '';
        $record['sub_active1'] = '';
    	$record['terms'] = Cms::where("type",1)->first();
    	return view("admin.termscondition",$record);
    }

    public function term_condition_update(Request $request){
    	$Validator = Validator::make($request->all(),[
    		"detail" => "required"
    	]);

    	if($Validator->fails()){
    		return redirect()->back()->with("error_message",$Validator->messages()->first());
    	}

        $cms = Cms::where("type",1)->first();
        if(empty($cms)){
           $cms = new Cms();
        }
        $cms->type = '1';
    	$cms->content = $request->detail;
    	$cms->save();
    	return redirect()->back()->with("message","Terms and condition updated successfully.");
    }

    public function policy(){
        $record['active'] = 'Policy';
        $record['sub_active'] = '';
        $record['sub_active1'] = '';
        $record['terms'] = Cms::where("type",2)->first();
        return view("admin.policy",$record);
    }

    public function policy_update(Request $request){

        $Validator = Validator::make($request->all(),[
            "detail" => "required"
        ]);
        if($Validator->fails()){
            return redirect()->back()->with("error_message",$Validator->messages()->first());
        }

        $cms =  Cms::where("type",2)->first();
        if(empty($cms)){
           $cms = new Cms();
        }
        $cms->type = '2';
        $cms->content    = @$request->detail;
        $cms->save();
        return redirect()->back()->with("message","Privacy policy updated successfully.");
    }

    public function aboutus()
    {
        $record['active'] = 'About';
        $record['sub_active'] = '';
        $record['sub_active1'] = '';
        $record['data'] = Aboutus::where("id",1)->first();

        return view("admin.aboutus",$record);
    }
    public function aboutus_update(Request $request)
    {

        $Validator = Validator::make($request->all(),[
            'content' => 'required',
        ]);

        if($Validator->fails()){
            //return redirect()->back()->withErrors($Validator);
            return redirect()->back()->with("error_message",$Validator->messages()->first());
        }
         $info = Aboutus::findOrFail(1);
        //$info = new Aboutus();
        $file = $request->file('image1');
            
        if(@$file){
            $file_array = ['jpg','jpeg','png'];
            $filetype = $file->getClientOriginalExtension();
            if(!in_array($filetype, $file_array)){
            return redirect()->back()->with("error_message","Please upload valid image, which support this format - jpg, jpeg, png.");
            }

            $image_path = 'storage/images/about_us/'.$info->image1;
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $imagename = strtotime('now').'.'.$filetype;
            $destinationPath = 'storage/images/about_us/';
            $file->move($destinationPath,$imagename);
            $info->image1 = $imagename;

           
        }
        $info->content1 = $request->content;

        $info->save();

        return back()->with('message','About Us updated successfully.');
    }


}
