<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;

class AdminProfileController extends Controller
{
    //
    public function AdminProfile(){
        $adminData =Admin::find(1);

        return view('admin/admin_profile_view', compact('adminData'));
    }

    public function AdminProfileEdit(){

        $editData =Admin::find(1);

        return view('admin/admin_profile_edit', compact('editData'));

    }
    public function AdminProfileStore(Request $request){

        // $adminData = DB::table('admins')->first();
        $data = Admin::find(1);
        
        $data -> name = $request->name;
        $data -> email = $request->email;


        if($request->file('profile_photo_path')){
            $file= $request->file('profile_photo_path');
            
            unlink(public_path('upload/admin_images/'.$data->profile_photo_path));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data->profile_photo_path = $filename;
        }

        $data->save();

        $notification =array(
            'message'=> 'Admin profile updated successfully',
            'alert-type'=> 'success'
        );

        return Redirect()->route('admin-profile')->with($notification);

    }//end method


    public function AdminChangePassword(){
    
       return view('admin/admin_change_password');

    }


    public function AdminUpdateChangePassword(Request $request){
        
        //validating data before we insert 
        $validateData = $request->validate([
            'oldpassword'=> 'required',
            'password'=> 'required|confirmed',
        ]);

        //taking our password from the DB
        $hashPassword = Admin::find(1)->password;

        //CONDITION 
        //if our old password matches our DB password
        if(Hash::check($request->oldpassword, $hashPassword)){
           //then take all the information
            $admin= Admin::find(1);
            //take only password and assign the new value with hash
            $admin->password = Hash::make($request->password);
            $admin->save();

            Auth::logout();

            return Redirect()->route('admin-logout');

        }else{
            return Redirect()->back();
        }
    }
}
