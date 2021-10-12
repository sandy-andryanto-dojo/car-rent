<?php

namespace App\Http\Controllers\Main\Transaction;

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Model;
use App\Models\Transaction;
use App\Models\Driver;
use App\Models\Customer;
use App\Models\Bank;
use App\Models\Brand;
use App\Models\Type;

class OrderController extends MainController{

    const TYPE = 1;

    public function __construct(){
        $this->layout = "main.transaction.order";
        $this->route = "orders";
        $this->title = "Order";
        $this->subtitle = "order management";
        $this->model = new Transaction;
        $this->dataTableModel = base64_encode(Transaction::class);
    }

    public function create(){
        $invoice_number  = Transaction::createInvoiceNumber(self::TYPE, "TRCH");
        $transaction = Transaction::create([
            'user_id'=> \Auth::user()->id,
            'is_purchased'=> 0,
            'invoice_date'=> date("Y-m-d"),
            'invoice_number'=> $invoice_number,
            "type"=> self::TYPE,
            'is_saved'=> 0,
        ]);
        $id = $transaction->id;
        return redirect()->route($this->route.".edit", ["id"=>$id]);
    }
 
    public function edit($id){
        $this->data["types"] = Type::orderBy("name", "ASC")->get();
        $this->data["models"] = Model::orderBy("name", "ASC")->get();
        $this->data["brands"] = Brand::orderBy("name", "ASC")->get();
        $this->data["banks"] = Bank::orderBy("name", "ASC")->get();
        $this->data["drivers"] = Driver::orderBy("name", "ASC")->get();
        $this->data["customers"] = Customer::orderBy("name", "ASC")->get();
        return parent::edit($id);
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