<?php

namespace App\Http\Controllers\Main\Car;

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use App\Models\Model;

class ModelController extends MainController{

    public function __construct(){
        $this->layout = "main.car.model";
        $this->route = "models";
        $this->title = "Model";
        $this->subtitle = "model management";
        $this->model = new Model;
        $this->dataTableModel = base64_encode(Model::class);
    }

    protected function createValidation(){
        return [
            'name' => 'required|unique:models',
        ];
    }

    protected function updateValidation($id){
        return [
            'name' => 'required|unique:models,name,' . $id,
        ];
    }

}