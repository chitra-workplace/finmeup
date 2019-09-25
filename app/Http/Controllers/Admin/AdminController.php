<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Admin;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $data['active'] = 'profile';
        $data['sub_active'] = '';
        $data['sub_active1'] = '';
        return view("admin.profile", $data);
    }

    public function changepassword()
    {
        $data['active'] = 'changepassword';
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


        // $Validator = Validator::make($request->all(),[
        //   "password" =>"required|confirmed|min:6"
        // ]);
        // if($Validator->fails()){
        //   return redirect()->back()->withErrors($Validator)->withInput();
        // }

        // Admin::where("id",Auth::guard('admin')->user()->id)->update(["password" => Hash::make($request->password)]);
        // return redirect()->back()->with("message","Admin Changed Password successfully.");
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

          if($request->hasFile('image')){

              $file_arr = ['jpg','jpeg','png'];
              $ext = $request->image->getClientOriginalExtension();
              if(!in_array($ext, $file_arr)){
                    $validator = Validator::make(['image'],[
                      'image' => 'required'
                    ],[
                        'image.required' => "Please choose valid image."
                    ]);
                    if($validator->fails()){
                      return redirect()->back()->withErrors($validator)->withInput();
                    }            
              }
            
              $mytime = Carbon::now();
              $todate = $mytime->toDateTimeString();

              $imagename = $request->image->getClientOriginalName();
              $ext = $request->image->getClientOriginalExtension();
              $imagename = strtotime($todate).'.'.$ext;
              $request->image->storeAs('public/adminimage', $imagename);

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
