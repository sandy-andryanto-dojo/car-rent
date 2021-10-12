<?php

namespace App\Http\Controllers\Main\Reference;

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use App\Models\Identity;

class IdentityController extends MainController{

    public function __construct(){
        $this->layout = "main.reference.identity";
        $this->route = "identities";
        $this->title = "Identity";
        $this->subtitle = "identity management";
        $this->model = new Identity;
        $this->dataTableModel = base64_encode(Identity::class);
    }

    protected function createValidation(){
        return [
            'name' => 'required|unique:identities',
        ];
    }

    protected function updateValidation($id){
        return [
            'name' => 'required|unique:identities,name,' . $id,
        ];
    }

}