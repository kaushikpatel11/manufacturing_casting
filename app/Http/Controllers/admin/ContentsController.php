<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use DataTables;
use App\Content;

class ContentsController extends Controller
{
    public function __construct() {

        $this->moduleRouteText = "contents";
        $this->moduleViewName = "admin.contents";
        $this->list_url = route($this->moduleRouteText.".index");

        $module = "Content";
        $this->module = $module;

        $this->modelObj = new Content();

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
        $data['title'] = "Content"; 
        $data['module_title'] = "Contents"; 
        $data['add_url'] = route($this->moduleRouteText.'.create');
        $data['addBtnName'] = 'Add Content';
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
            'size' => 'required',
            'qn_no' => 'required|numeric',
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
            $module->size = $request->get('size');
            $module->qn_no = $request->get('qn_no');
            $module->save();

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
            'size' => 'required',
            'qn_no' => 'required|numeric',
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
            $model->size = $request->get('size');
            $model->qn_no = $request->get('qn_no');
            $model->save();

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
        $model = Content::query();

        return DataTables::eloquent($model)
            ->addColumn('action', function($row) {
                $isEdit = '<a href="'.route($this->moduleRouteText.'.edit',['content' => $row->id]).'" class="btn btn-sm btn-dark" title="Edit"><i class="fa fa-edit"></i></a>';
                $isDelete = '<a data-id="{{ $row->id }}" href="'.route($this->moduleRouteText.'.destroy',['content' => $row->id]).'" class="btn btn-sm btn-dark btn-delete-record" title="Delete"><i class="fa fa-trash-o"></i></a>';
                return $isEdit.' '.$isDelete;
            })
            ->editColumn('created_at', function($row){
                return date("Y-m-d H:s:i",strtotime($row->created_at));    
            })
            ->rawColumns(['action'])
            ->filter(function ($query)
            {
                $search_title = request()->get("search_title");

                if(!empty($search_title))
                {
                    $query = $query->where('title', 'LIKE', '%'.$search_title.'%');
                }
            })->make(true);
    }
}
