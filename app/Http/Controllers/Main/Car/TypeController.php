<?php

namespace App\Http\Controllers\Main\Car;

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use App\Models\Type;

class TypeController extends MainController{

    public function __construct(){
        $this->layout = "main.car.type";
        $this->route = "types";
        $this->title = "Type";
        $this->subtitle = "type management";
        $this->model = new Type;
        $this->dataTableModel = base64_encode(Type::class);
    }

    protected function createValidation(){
        return [
            'name' => 'required|unique:types',
        ];
    }

    protected function updateValidation($id){
        return [
            'name' => 'required|unique:types,name,' . $id,
        ];
    }

}