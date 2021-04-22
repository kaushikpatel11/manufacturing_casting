<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Setting;
use Validator;

class SettingsController extends Controller
{
    public function index(Request $request)
    {
        $data = array();
        $data['title'] = "Setting"; 
        $data['module_title'] = "Setting";
        $data['formObj'] = Setting::latest()->first();
        $data['list_url'] = route('settings');

        return view("admin.settings.index", $data);
    }
    public function update(Request $request)
    {
        $status = 1;
        $msg = 'Setting updated successfully!';
        $data = array();

        $validator = Validator::make($request->all(), [
            'description' => 'required',
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
        	$model = new Setting();
            $model->description = $request->get('description');
            $model->save();

            $image = $request->file('logo');
            if(!empty($image))
            {
                $destinationPath = 'uploads'.DIRECTORY_SEPARATOR.'settings';

                $image_name  =  $image->getClientOriginalName();
                $extension   =  $image->getClientOriginalExtension();
                $image_name  =  md5($image_name);
                $file_image  =  $image_name.'.'.$extension;
                $file        =  $image->move($destinationPath, $file_image);

                $model->logo = $file_image;
                $model->save();
            }
            $image = $request->file('logo_mini');
            if(!empty($image))
            {
                $destinationPath = 'uploads'.DIRECTORY_SEPARATOR.'settings';

                $image_name  =  $image->getClientOriginalName();
                $extension   =  $image->getClientOriginalExtension();
                $image_name  =  md5($image_name);
                $file_image  =  $image_name.'.'.$extension;
                $file        =  $image->move($destinationPath, $file_image);

                $model->logo_mini = $file_image;
                $model->save();
            }
            session()->flash('success_message', $msg);
        }
        
        return ['status' => $status, 'msg' => $msg, 'data' => $data];       
    }
}
