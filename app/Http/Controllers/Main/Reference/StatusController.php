<?php

namespace App\Http\Controllers\Main\Reference;

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use App\Models\Status;

class StatusController extends MainController{

    public function __construct(){
        $this->layout = "main.reference.status";
        $this->route = "status";
        $this->title = "status";
        $this->subtitle = "status management";
        $this->model = new Status;
        $this->dataTableModel = base64_encode(Status::class);
    }

    protected function createValidation(){
        return [
            'name' => 'required|unique:status',
        ];
    }

    protected function updateValidation($id){
        return [
            'name' => 'required|unique:status,name,' . $id,
        ];
    }

}