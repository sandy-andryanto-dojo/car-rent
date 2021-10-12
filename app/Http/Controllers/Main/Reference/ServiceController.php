<?php

namespace App\Http\Controllers\Main\Reference;

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends MainController{

    public function __construct(){
        $this->layout = "main.reference.service";
        $this->route = "services";
        $this->title = "Service";
        $this->subtitle = "service management";
        $this->model = new Service;
        $this->dataTableModel = base64_encode(Service::class);
    }

    protected function createValidation(){
        return [
            'name' => 'required|unique:services',
        ];
    }

    protected function updateValidation($id){
        return [
            'name' => 'required|unique:services,name,' . $id,
        ];
    }

}