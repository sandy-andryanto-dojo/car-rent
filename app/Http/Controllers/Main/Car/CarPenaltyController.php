<?php

namespace App\Http\Controllers\Main\Car;

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use App\Models\CarPenalty;
use App\Models\Car;

class CarPenaltyController extends MainController{

    public function __construct(){
        $this->layout = "main.car.penalty";
        $this->route = "car_penalties";
        $this->title = "Penalty";
        $this->subtitle = "penalty management";
        $this->model = new CarPenalty;
        $this->dataTableModel = base64_encode(CarPenalty::class);
    }

    public function create(){
        $this->data["cars"] = Car::orderBy("id_number", "ASC")->get();
        return parent::create();
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