<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Str;
use Hash;
use Image;

class profileController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('profile');
    }
    public function namechange(Request $request){
        $request->validate([
            'name' => 'required'
        ]);
        User::find(Auth::id())->update([
            'name' => $request->name
        ]);
        return back()->with('success', 'Your name changed successfully');
    }
    public function passwordchange(Request $request){
        $request->validate([
            '*' => 'required',
            // 'password' => 'required',
            // 'confirm_password' => 'required',
        ]);
        if(Hash::check($request->old_password, Auth::user()->password)){
            if($request->password == $request->confirm_password){
                User::find(Auth::id())->update([
                    'password' => bcrypt($request->password)
                ]);
                return back()->with('success_p', 'password change successfully');
            }
            else{
                return back()->withErrors("Your new password and confirm password Does not matched");
            }
        }
        else{
            return back()->withErrors("Your old password Does not matched");
        }
    }
      public function photochange (Request $request){
          $request->validate([
              'new_profile_photo' => 'required|image'
          ]);
          if(Auth::user()->profile_photo != 'defolt.jpg'){
            unlink(base_path('public/uploads/profile-pic/'.Auth::user()->profile_photo));
          }
           $new_profile_photo_name = Auth::id().'-'.time().'-'.Str::random(5).".".$request->file('new_profile_photo')->getClientOriginalextension();
            $img = Image::make($request->file('new_profile_photo'))->resize(500,500)->save(base_path('public/uploads/profile-pic/'.$new_profile_photo_name));
            User::find(Auth::id())->update([
                'profile_photo' => $new_profile_photo_name,
            ]);
            return back()->with('photo-success','Photo Uploaded successfully');
          }
    }
