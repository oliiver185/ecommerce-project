<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class IndexController extends Controller
{
    //
    public function index(){   
        return view('frontend/index');
    }
    
    public function UserLogout(){
        Auth::logout();

        return Redirect()->route('login');
    }

    public function UserProfile(){

        $id = Auth::user()->id;
        $user = User::find($id);

        return view('frontend/profile/user_profile', compact('user'));
    }
    public function UserProfileStore(Request $request){
        $id = Auth::user()->id;
        // $userData = DB::table('admins')->first();
        $data = User::find($id);
        
        $data -> name = $request->name;
        $data -> email = $request->email;
        $data -> phone = $request->phone;


        if($request->file('profile_photo_path')){
            $file= $request->file('profile_photo_path');
            
            @unlink(public_path('upload/user_images/'.$data->profile_photo_path));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $data->profile_photo_path = $filename;
        }

        $data->save();

        $notification =array(
            'message'=> 'User profile updated successfully',
            'alert-type'=> 'success'
        );

        return Redirect()->route('dashboard')->with($notification);

    }//end method


    public function UserChangePassword(){
        
        //eloquent 
        $id = Auth::user()->id;
        $user = User::find($id);

        //query builder
        // $user = DB::table('users')->where('id', Auth::user()->id)->first();
        return view('frontend/profile/change_password', compact('user'));
    }

    public function my_UserPasswordUpdate(Request $request){
        
        //validating data before we insert 
        $validateData = $request->validate([
            'old_password'=> 'required',
            'password'=> 'required|confirmed',
        ]);

        $id = Auth::id();
        //taking our password from the DB
        $hashPassword = User::find($id)->password;

        //CONDITION 
        //if our old password matches our DB password
        if(Hash::check($request->old_password, $hashPassword)){
           //then take all the information
            $admin= User::find($id);
            //take only password and assign the new value with hash
            $admin->password = Hash::make($request->password);
            $admin->save();

            Auth::logout();

            return Redirect()->route('admin-logout');

        }else{
            return Redirect()->back();
        }
    }
    
    public function UserPasswordUpdate(Request $request){
        
        //validating data before we insert 
        $validateData = $request->validate([
            'old_password'=> 'required',
            'password'=> 'required|confirmed',
        ]);

        //taking our password from the DB
        // $hashPassword = Admin::find(1)->password;
        $hashPassword = Auth::user()->password;

        //CONDITION 
        //if our old password matches our DB password
        if(Hash::check($request->old_password, $hashPassword)){
           //then take all the information
            $user= User::find(Auth::id());
            //take only password and assign the new value with hash
            $user->password = Hash::make($request->password);
            $user->save();

            Auth::logout();

            return Redirect()->route('admin-logout');

        }else{
            return Redirect()->back();
        }
    }
}
