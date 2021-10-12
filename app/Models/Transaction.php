<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Traits\DataTable;
// Relations
use App\Models\Bank;
use App\Models\User;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\TransactionPenalty;
use App\Models\TransactionService;
use DB;

class Transaction extends Model implements Auditable{
    
    use SoftDeletes, DataTable, \OwenIt\Auditing\Auditable;

    const TYPE_ORDER = 1;
    const TYPE_PURCHASE = 2;

    protected $dates = ['deleted_at'];
    protected $table = 'transactions';
    protected $fillable = [
        "bank_id",
        "user_id",
        "customer_id",
        "driver_id",
        "is_purchased",
        "is_saved",
        "creditcard_number",
        "invoice_date",
        "invoice_number",
        "type",
        "day_duration",
        "date_start",
        "date_end",
        "date_back",
        "deposit",
        "bill",
        "subtotal",
        "tax",
        "discount",
        "grandtotal",
        "cash",
        "change",
        "notes",
        "description"
    ];

    public function Bank() {
        return $this->belongsTo(Bank::class, "bank_id");
    }

    public function User() {
        return $this->belongsTo(User::class, "user_id");
    }

    public function Customer() {
        return $this->belongsTo(Customer::class, "customer_id");
    }

    public function Driver() {
        return $this->belongsTo(Driver::class, "driver_id");
    }

    public function TransactionPenalty() {
        return $this->hasMany(TransactionPenalty::class);
    }

    public function TransactionService() {
        return $this->hasMany(TransactionService::class);
    }

    public function getType(){
        return $this->type;
    }

    public function setType($type){
        $this->type = $type;
        return $this;
    }

    public static function createInvoiceNumber($type, $code){
        $sql = "SELECT MAX(invoice_number) as max_number FROM transactions WHERE type = ".$type." AND invoice_date <=  DATE(now())";
        $data = DB::select($sql);
        if(!is_null($data) && isset($data[0]->max_number)){
            $arr = explode(".", $data[0]->max_number);
            $val = (int) $arr[2] + 1;
            $digit = 5;
            $i_number = strlen($val);
            for ($i = $digit; $i > $i_number; $i--) {
                $val = "0" . $val;
            }
            return $code.".".date("Ymd").".".$val;
        }
        return $code.".".date("Ymd").".00001";
    }

    public function selectData(){
        return [
           "transactions.created_at",
           "transactions.invoice_number",
           'users.username',
           'customers.name as customer_name',
           'drivers.name as driver_name',
           "transactions.day_duration",
           "transactions.date_start",
           "transactions.date_end",
           "transactions.is_saved",
           "transactions.id as key_id",
           'users.first_name',
           'users.last_name',
        ];
    }

    public function dataTableQuery(){
        $type = $this->getType();
        $query = self::where("transactions.id", "<>", 0);
        $query->where("transactions.type", $type);
        $query->leftJoin("users", "users.id", "transactions.user_id");
        $query->leftJoin("drivers", "drivers.id", "transactions.driver_id");
        $query->leftJoin("customers", "customers.id", "transactions.customer_id");
        return $query;
    }

}
