<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Admin;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function index()
    {
        $data['active'] = 'Profile';
        $data['sub_active'] = '';
        $data['sub_active1'] = '';
        return view("admin.profile", $data);
    }

    public function changepassword()
    {
        $data['active'] = 'ChangePassword';
        $data['sub_active'] = '';
        $data['sub_active1'] = '';
        return view("admin.changepassword", $data);
    }

    public function updatePassword(Request $request)
    {
        $message=[
            'confirm_password.same' => 'The Confirm Password does not match.'
        ];
        $Validator = Validator::make($request->all(),[
          'old_password' => 'required|string',
          'password' => 'required|min:6',
          'confirm_password' => 'required|same:password'
        ], $message);

        if($Validator->fails()){
          return redirect()->back()->withErrors($Validator)->withInput();
         //   return redirect()->back()->with("error_message",$Validator->messages()->first());
        }

        $user = Auth::guard('admin')->user();
        $hashedPassword = $user->password;

        if(Hash::check($request->old_password, $hashedPassword))
        {
            $info = Admin::findOrFail($user->id);
            $info->password = Hash::make($request->password);
            $info->save();

            return redirect()->back()->with('message','Password Changed Successfully');
        }
        else
        {
            return redirect()->back()->with('error_message','Invalid Old password!!.');
        }

    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name' =>'required',
            'email' => 'required'
          ]);
          if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
          }
            $file = $request->file('image');
            if(@$file){
	            $file_array = ['jpg','jpeg','png'];
	            $filetype = $file->getClientOriginalExtension();
	            if(!in_array($filetype, $file_array)){
	            return redirect()->back()->with("error_message","Please upload valid image, which support this format - jpg, jpeg, png.");
	            }
	            $imagename = strtotime('now').'.'.$filetype;
	            $destinationPath = 'storage/images/adminimage/';
	            $image_path = $destinationPath.$imagename;
	            $oldimage = Auth::guard('admin')->user()->image;
	            
	           	$existingimagepath = $destinationPath.$oldimage;
	            if($file->move($destinationPath,$imagename)){
	            	 if(File::exists($existingimagepath)) {
			                File::delete($existingimagepath);
			            }
	            }
             Admin::where("id",Auth::guard('admin')->user()->id)->update(['name' => $request->name,'image' => $imagename]);
          }else{
             Admin::where("id",Auth::guard('admin')->user()->id)->update(['name' => $request->name]);
          }

          return redirect()->back()->with("message","Profile has been updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
