<?php

namespace App\Http\Controllers\Main\Reference;

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\Identity;

class DriverController extends MainController{

    public function __construct(){
        $this->layout = "main.reference.driver";
        $this->route = "drivers";
        $this->title = "Driver";
        $this->subtitle = "driver management";
        $this->model = new Driver;
        $this->dataTableModel = base64_encode(Driver::class);
    }

    public function create(){
        $this->data["identities"] = Identity::orderBy("name", "ASC")->get();
        return parent::create();
     }
 
    public function edit($id){
         $this->data["identities"] = Identity::orderBy("name", "ASC")->get();
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
            $this->uploadImage($id, $request);
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
            $this->uploadImage($id, $request);
            return redirect()->route($this->route.".show", ["id"=>$id])->with('success', self::SUCCESS_MESSAGE_UPDATED);
        }
    }

    private function uploadImage($id, Request $request){
        if($request->file('image')){
            $image = null;
            $file = $request->file('image');
            $imageName = md5("driver".rand(0,1000)."".time()).'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $file->move($destinationPath, $imageName);
            $image = 'uploads/'.$imageName;
            $current = Driver::where("id", $id)->first();
            if(!is_null($current->image)){
                if(file_exists(public_path($current->image))){
                    unlink(public_path($current->image));
                }
            }
            $current->image = $image;
            $current->save();
        }
    }

    protected function createValidation(){
        return [
            'code' => 'required|unique:drivers',
            'name'=>  'required|unique:drivers',
            'phone'=>  'required|unique:drivers',
        ];
    }

    protected function updateValidation($id){
        return [
            'code' => 'required|unique:drivers,code,' . $id,
            'name' => 'required|unique:drivers,name,' . $id,
            'phone' => 'required|unique:drivers,phone,' . $id,
        ];
    }

}