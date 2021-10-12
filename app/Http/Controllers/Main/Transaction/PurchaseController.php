<?php

namespace App\Http\Controllers\Main\Transaction;

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use App\Models\Transaction;

class PurchaseController extends MainController{

    public function __construct(){
        $this->layout = "main.transaction.purchase";
        $this->route = "purchases";
        $this->title = "Purchase";
        $this->subtitle = "purchase management";
        $this->model = new Transaction;
        $this->dataTableModel = base64_encode(Transaction::class);
    }

    protected function createValidation(){
        return [
            'name' => 'required|unique:brands',
        ];
    }

    protected function updateValidation($id){
        return [
            'name' => 'required|unique:brands,name,' . $id,
        ];
    }

}