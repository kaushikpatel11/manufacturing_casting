<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Banner;
use App\Product;
use App\Content;
use App\User;

class AdminController extends Controller
{
    public function index(Request $request)
    {                          
        $data = array(); 
        $data['page_title'] = "Dashboard";
        $data['title'] = "Dashboard";
        $data['banner_count'] = Banner::count();
        $data['product_count'] = Product::count();
        $data['content_count'] = Content::count();

        return view('admin.dashboard',$data);
    }
    public function changePassword()
    {        
        $data = array();
        $data['title'] = "Change Password";
        $data['page_title'] = "Change Password";
        $data['formObj'] = \Auth::user();
        return view('admin.change_password',$data);        
    }    
    
    public function postChangePassword(Request $request)
    {
        $status = 1;
        $msg = "Your password has been changed successfully.";

        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6',
            'new_password' => 'required|min:6|confirmed',
            'new_password_confirmation' => 'required',
        ]);        

        if ($validator->fails()) 
        {
            $messages = $validator->messages();
            
            $status = 0;
            $msg = "";
            
            foreach ($messages->all() as $message) 
            {
                $msg .= $message . "<br />";
            }            
        }
        else
        {
            $user = Auth::user();
            
            $old_password = $request->get('password');
            
            if(Hash::check($old_password, $user->password))
            {
                $user->password = bcrypt($request->get('new_password'));
                $user->save();
            }
            else
            {
                $status = 0;
                $msg = 'old password is incorrect.';
            }
        }        
        
        return ['status' => $status, 'msg' => $msg];
    }    
    
    public function editProfile()
    {
        $data = array();
        $data['title'] = "My Profile";
        $data['page_title'] = "My Profile";
        $data['formObj'] = \Auth::user();

        return view('admin.my_profile',$data);        
    }    
    
    public function updateProfile(Request $request)
    {
        $status = 1;
        $msg = "Your profile has been changed successfully.";

        $validator = Validator::make($request->all(), [
            'image' => 'required|image|max:4000',
            'name' => 'required|min:2',
            'email' => 'required|unique:users,email,'.\Auth::user()->id,
        ]);        

        if($validator->fails())
        {
            $messages = $validator->messages();
            
            $status = 0;
            $msg = "";
            
            foreach ($messages->all() as $message) 
            {
                $msg .= $message . "<br />";
            }
        }
        else
        {
        	$id = \Auth::user()->id;

            $user = User::find($id);
            if(!$user)
                return abort(404);

            $image = $request->file("image");

            if(!empty($image))
            {
                $destinationPath = 'uploads'.DIRECTORY_SEPARATOR.'users';

                $image_name  =  $image->getClientOriginalName();
                $extension   =  $image->getClientOriginalExtension();
                $image_name  =  md5($image_name);
                $file_image  =  $image_name.'.'.$extension;
                $file        =  $image->move($destinationPath, $file_image);

                $user->image = $file_image;
                $user->save();
            }
            $user->email 	= $request->get('email');
            $user->name 	= $request->get('name');
            $user->save();
        }
        return ['status' => $status, 'msg' => $msg];
    }
}
