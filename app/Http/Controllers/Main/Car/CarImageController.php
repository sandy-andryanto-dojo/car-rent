<?php

namespace App\Http\Controllers\Main\Car;

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\CarImage;

class CarImageController extends MainController{

    public function __construct(){
        $this->layout = "main.car.image";
        $this->route = "car_images";
        $this->title = "Images";
        $this->subtitle = "car images";
        $this->model = new CarImage;
        $this->dataTableModel = base64_encode(CarImage::class);
    }

    public function create(){
       $this->data["cars"] = Car::orderBy("id_number", "ASC")->get();
       return parent::create();
    }

    public function store(Request $request){
        $rules = $this->createValidation();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }else{
            $image = "assets/dist/img/no-image.png";
            if($request->file('image')){
                $file = $request->file('image');
                $imageName = md5("car_images".rand(0,1000)."".time()).'.'.$file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads');
                $file->move($destinationPath, $imageName);
                $image = 'uploads/'.$imageName;
            }
            $model = CarImage::create([
                "car_id" => $request->get("car_id"),
                "path" => $image,
                "is_primary" => $request->get("is_primary") ? 1 : 0,
            ]);
            if($request->get("is_primary")){
                CarImage::where("id", "!=", $model->id)->update(["is_primary" => 0]);
            }
            return redirect()->route($this->route.".show", ["id"=>$model->id])->with('success', self::SUCCESS_MESSAGE_CREATED);
        }
    }

    public function update($id, Request $request){
        $rules = $this->updateValidation($id);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }else{

            $model = CarImage::where("id", $id)->first();
            $image = isset($model->path) ? $model->path : "assets/dist/img/no-image.png";
            if($request->file('image')){
                if(isset($model->path)){
                    if(file_exists(public_path($model->path))){
                        unlink(public_path($model->path));
                    }
                }
                $file = $request->file('image');
                $imageName = md5(rand(0,1000)."".time()).'.'.$file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads');
                $file->move($destinationPath, $imageName);
                $image = 'uploads/'.$imageName;
            }

            $model->car_id = $request->get("car_id");
            $model->path = $image;
            $model->is_primary =  $request->get("is_primary") ? 1 : 0;
            $model->save();

            if($request->get("is_primary")){
                CarImage::where("id", "!=", $model->id)->update(["is_primary" => 0]);
            }

            return redirect()->route($this->route.".show", ["id"=>$model->id])->with('success', self::SUCCESS_MESSAGE_UPDATED);
            
        }
    }

    public function edit($id){
        $this->data["cars"] = Car::orderBy("id_number", "ASC")->get();
        return parent::edit($id);
     }

    protected function createValidation(){
        return [
            'car_id' => 'required',
        ];
    }

    protected function updateValidation($id){
        return $this->createValidation();
    }

}