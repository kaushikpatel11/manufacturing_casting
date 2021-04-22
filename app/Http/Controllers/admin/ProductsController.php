<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use DataTables;
use App\Product;

class ProductsController extends Controller
{
    public function __construct() {

        $this->moduleRouteText = "products";
        $this->moduleViewName = "admin.products";
        $this->list_url = route($this->moduleRouteText.".index");

        $module = "Product";
        $this->module = $module;

        $this->modelObj = new Product();

        $this->addMsg = $module . " has been added successfully!";
        $this->updateMsg = $module . " has been updated successfully!";
        $this->deleteMsg = $module . " has been deleted successfully!";
        $this->deleteErrorMsg = $module . " can not deleted!";

        view()->share("list_url", $this->list_url);
        view()->share("moduleRouteText", $this->moduleRouteText);
        view()->share("moduleViewName", $this->moduleViewName);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = array();
        $data['title'] = "Product"; 
        $data['module_title'] = "Products"; 
        $data['add_url'] = route($this->moduleRouteText.'.create');
        $data['addBtnName'] = 'Add Product';
        $data['btnAdd'] = 1;

        return view($this->moduleViewName.".index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        $data = array();
        $data['formObj'] = $this->modelObj;
        $data['title'] = "Add ".$this->module;
        $data['action_url'] = $this->moduleRouteText.".store";
        $data['action_params'] = 0;
        $data['buttonText'] = "Save";
        $data["method"] = "POST";

        return view($this->moduleViewName.'.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status = 1;
        $msg = $this->addMsg;
        $data = array();
        $module = $this->modelObj;

        $validator = Validator::make($request->all(), [
            'title' => 'required|min:2',
            'description' => 'required',
            'product_code' => 'required|unique:products,product_code',
            'logo' => 'required',
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
            $module->title = $request->get('title');
            $module->description = $request->get('description');
            $module->product_code = $request->get('product_code');
            $module->save();
            $id = $module->id;

            $logo = $request->file('logo');
            if(!empty($logo))
            {
                $destinationPath = 'uploads'.DIRECTORY_SEPARATOR.'products'.DIRECTORY_SEPARATOR.$id;

                $image_name  =  $logo->getClientOriginalName();
                $extension   =  $logo->getClientOriginalExtension();
                $image_name  =  md5($image_name);
                $file_image  =  $image_name.'.'.$extension;
                $file        =  $logo->move($destinationPath, $file_image);

                $module->logo = $file_image;
                $module->save();
            }

            $image = $request->file('image');
            if(!empty($image))
            {
                $destinationPath = 'uploads'.DIRECTORY_SEPARATOR.'products'.DIRECTORY_SEPARATOR.$id;

                $image_name  =  $image->getClientOriginalName();
                $extension   =  $image->getClientOriginalExtension();
                $image_name  =  md5($image_name);
                $file_image  =  $image_name.'.'.$extension;
                $file        =  $image->move($destinationPath, $file_image);

                $module->image = $file_image;
                $module->save();
            }

            session()->flash('success_message', $msg);
        }

        return ['status' => $status, 'msg' => $msg, 'data' => $data];        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $formObj = $this->modelObj->find($id);

        if(!$formObj)
        {
            abort(404);
        }   

        $data = array();
        $data['formObj'] = $formObj;
        $data['title'] = "Edit ".$this->module;
        $data['buttonText'] = "Update";
        $data['action_url'] = $this->moduleRouteText.".update";
        $data['action_params'] = $formObj->id;
        $data['method'] = "PUT";

        return view($this->moduleViewName.'.add', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = $this->modelObj->find($id);

        $status = 1;
        $msg = $this->updateMsg;
        $data = array();

        $validator = Validator::make($request->all(), [
            'title' => 'required|min:2',
            'description' => 'required',
            'product_code' => 'required|unique:products,product_code,'.$id,
        ]);
        
        // check validations
        if(!$model)
        {
            $status = 0;
            $msg = "Record not found !";
        }
        else if ($validator->fails()) 
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
            $model->title = $request->get('title');
            $model->description = $request->get('description');
            $model->product_code = $request->get('product_code');
            $model->save();

            $logo = $request->file('logo');
            if(!empty($logo))
            {
                $destinationPath = 'uploads'.DIRECTORY_SEPARATOR.'products'.DIRECTORY_SEPARATOR.$id;

                $image_name  =  $logo->getClientOriginalName();
                $extension   =  $logo->getClientOriginalExtension();
                $image_name  =  md5($image_name);
                $file_image  =  $image_name.'.'.$extension;
                $file        =  $logo->move($destinationPath, $file_image);

                $model->logo = $file_image;
                $model->save();
            }
            $image = $request->file('image');
            if(!empty($image))
            {
                $destinationPath = 'uploads'.DIRECTORY_SEPARATOR.'products'.DIRECTORY_SEPARATOR.$id;

                $image_name  =  $image->getClientOriginalName();
                $extension   =  $image->getClientOriginalExtension();
                $image_name  =  md5($image_name);
                $file_image  =  $image_name.'.'.$extension;
                $file        =  $image->move($destinationPath, $file_image);

                $model->image = $file_image;
                $model->save();
            }

            session()->flash('success_message', $msg);
        }
        
        return ['status' => $status, 'msg' => $msg, 'data' => $data];       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        $modelObj = $this->modelObj->find($id);

        if($modelObj) 
        {
            try 
            {
                $url = public_path().'/uploads/products/'.$id.'/'.$modelObj->logo;
                if (is_file($url)) {
                    unlink($url);
                }
                $url = public_path().'/uploads/products/'.$id.'/'.$modelObj->image;
                if (is_file($url)) {
                    unlink($url);
                }

                $backUrl = $request->server('HTTP_REFERER');
                $modelObj->delete();
                session()->flash('success_message', $this->deleteMsg); 

                return redirect($backUrl);
            } 
            catch (Exception $e) 
            {
                session()->flash('error_message', $this->deleteErrorMsg);
                return redirect($this->list_url);
            }
        } 
        else 
        {
            session()->flash('error_message', "Record not exists");
            return redirect($this->list_url);
        }
    }
    public function data(Request $request)
    {
        $model = Product::query();

        return DataTables::eloquent($model)
            ->addColumn('action', function($row) {
                $isEdit = '<a href="'.route($this->moduleRouteText.'.edit',['product' => $row->id]).'" class="btn btn-sm btn-dark" title="Edit"><i class="fa fa-edit"></i></a>';
                $isDelete = '<a data-id="{{ $row->id }}" href="'.route($this->moduleRouteText.'.destroy',['product' => $row->id]).'" class="btn btn-sm btn-dark btn-delete-record" title="Delete"><i class="fa fa-trash-o"></i></a>';
                return $isEdit.' '.$isDelete;
            })
            ->editColumn('created_at', function($row){
                return date("Y-m-d H:s:i",strtotime($row->created_at));    
            })
            ->editColumn('logo', function($row){
                if(!empty($row->logo)){
                    $img = asset('/uploads/products/'.$row->id.'/'.$row->logo);
                    return "<img src='$img' width='200px' height='200px'>";
                }
                else{
                    $img = asset('/images/default.png');
                    return "<img src='$img' width='200px' height='200px'>";
                }
            })
            ->editColumn('image', function($row){
                if(!empty($row->image)){
                    $img = asset('/uploads/products/'.$row->id.'/'.$row->image);
                    return "<img src='$img' width='200px' height='200px'>";
                }
                else{
                    $img = asset('/images/default.png');
                    return "<img src='$img' width='200px' height='200px'>";
                }
            })
            ->rawColumns(['action','logo','image'])
            ->filter(function ($query)
            {
                $search_title = request()->get("search_title");
                $search_product_code = request()->get("search_product_code");

                if(!empty($search_title))
                {
                    $query = $query->where('title', 'LIKE', '%'.$search_title.'%');
                }

                if(!empty($search_product_code))
                {
                    $query = $query->where('product_code', 'LIKE', '%'.$search_product_code.'%');
                }
            })->make(true);
    }
}
