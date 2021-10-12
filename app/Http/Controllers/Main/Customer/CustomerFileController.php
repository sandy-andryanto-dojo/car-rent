<?php

namespace App\Http\Controllers\Main\Customer;

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\CustomerFile;
use App\Models\Customer;

class CustomerFileController extends MainController{

    public function __construct(){
        $this->layout = "main.customer.file";
        $this->route = "customer_files";
        $this->title = "File";
        $this->subtitle = "file management";
        $this->model = new CustomerFile;
        $this->dataTableModel = base64_encode(CustomerFile::class);
    }

    public function create(){
        $this->data["customers"] = Customer::orderBy("name", "ASC")->get();
        return parent::create();
     }
 
    public function edit($id){
         $this->data["customers"] = Customer::orderBy("name", "ASC")->get();
         return parent::edit($id);
    }

    public function store(Request $request){
        $rules = $this->createValidation();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }else{
            $post = $request->all();
            $data = $this->model->create($post);
            $id = $data->id;
            $this->uploadFile($id, $request);
            return redirect()->route($this->route.".show", ["id"=>$id])->with('success', self::SUCCESS_MESSAGE_CREATED);
        }
    }

    public function update($id, Request $request){
        $rules = $this->updateValidation($id);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }else{
            $post = $request->all();
            $data = $this->model->where("id", $id)->first();
            $data->fill($post);
            $data->save();
            $this->uploadFile($id, $request);
            return redirect()->route($this->route.".show", ["id"=>$id])->with('success', self::SUCCESS_MESSAGE_UPDATED);
        }
    }

    private function uploadFile($id, Request $request){
        if($request->file('attachment')){
            $attachment = null;
            $file = $request->file('attachment');
            $attachmentName = md5("customer_file".rand(0,1000)."".time()).'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $file->move($destinationPath, $attachmentName);
            $path = 'uploads/'.$attachmentName;
            $current = CustomerFile::where("id", $id)->first();
            if(!is_null($current->path)){
                if(file_exists(public_path($current->path))){
                    unlink(public_path($current->path));
                }
            }
            $current->path = $path;
            $current->save();
        }
    }

    protected function createValidation(){
        return [
            'customer_id' => 'required',
            'attachment'=>  'required',
            'description'=>  'required',
        ];
    }

    protected function updateValidation($id){
        return $this->createValidation();
    }

}