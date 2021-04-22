<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use App\User;
use Validator;

class AdminLoginController extends Controller
{    
    public $redirectPath = 'admin';
    public $redirectAfterLogout = 'admin/login';
    public $loginPath = 'admin/login'; 

    public function __construct()
    {
        //$this->middleware('guest_admin', ['except' => 'getLogout']);
    }
    public function getLogin()
    {                
        return view('admin.before_login.login');
    }
    public function postLogin(Request $request)
    {        
        $status = 0;
        $msg = "The credential that you've entered doesn't match any account.";
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        // check validations
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
            if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) 
            {
                $user = Auth::user();

                $status = 1;
                $msg = "Logged in successfully.";
            }
        }
        
        if($request->isXmlHttpRequest())
        {
            return ['status' => $status, 'msg' => $msg];
        }
        else
        {
            if($status == 0)
            {
                session()->flash('error_message', $msg);
            }
            
            return redirect('admin/login');
        }
    }
    public function getLogout()
    {
        Auth::logout();
        return redirect($this->redirectAfterLogout);
    } 

}
