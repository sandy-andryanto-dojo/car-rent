<?php

namespace App\Http\Controllers\Main\Reference;

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use App\Models\Fuel;

class FuelController extends MainController{

    public function __construct(){
        $this->layout = "main.reference.fuel";
        $this->route = "fuels";
        $this->title = "Fuel";
        $this->subtitle = "fuel management";
        $this->model = new Fuel;
        $this->dataTableModel = base64_encode(Fuel::class);
    }

    protected function createValidation(){
        return [
            'name' => 'required|unique:fuels',
        ];
    }

    protected function updateValidation($id){
        return [
            'name' => 'required|unique:fuels,name,' . $id,
        ];
    }

}