<?php

namespace App\Http\Controllers\Main\Car;

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Brand;
use App\Models\Model;
use App\Models\Status;
use App\Models\Type;
use App\Models\Fuel;

class VehicleController extends MainController{

    public function __construct(){
        $this->layout = "main.car.vehicle";
        $this->route = "vehicles";
        $this->title = "Vehicle";
        $this->subtitle = "vehicle management";
        $this->model = new Car;
        $this->dataTableModel = base64_encode(Car::class);
    }

    public function create(){
        $this->data["brands"] = Brand::orderBy("name", "ASC")->get();
        $this->data["models"] = Model::orderBy("name", "ASC")->get();
        $this->data["status"] = Status::orderBy("name", "ASC")->get();
        $this->data["types"] = Type::orderBy("name", "ASC")->get();
        $this->data["fuels"] = Fuel::orderBy("name", "ASC")->get();
        return parent::create();
     }
 
    public function edit($id){
        $this->data["brands"] = Brand::orderBy("name", "ASC")->get();
        $this->data["models"] = Model::orderBy("name", "ASC")->get();
        $this->data["status"] = Status::orderBy("name", "ASC")->get();
        $this->data["types"] = Type::orderBy("name", "ASC")->get();
        $this->data["fuels"] = Fuel::orderBy("name", "ASC")->get();
        return parent::edit($id);
    }

    protected function createValidation(){
        return [
            'brand_id' => 'required',
            'model_id' => 'required',
            'status_id' => 'required',
            'type_id' => 'required',
            'fuel_id' => 'required',
            'color' => 'required',
            'id_number' => 'required|unique:cars',
        ];
    }

    protected function updateValidation($id){
        return [
            'brand_id' => 'required',
            'model_id' => 'required',
            'status_id' => 'required',
            'type_id' => 'required',
            'fuel_id' => 'required',
            'color' => 'required',
            'id_number' => 'required|unique:cars,id_number,' . $id,
        ];
    }

}