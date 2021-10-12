<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Traits\DataTable;
// Relations
use App\Models\Customer;

class CustomerFile extends Model implements Auditable {

    use DataTable, \OwenIt\Auditing\Auditable;

    protected $dates = ['deleted_at'];
    protected $table = 'customers_files';
    protected $fillable = [
        'customer_id',
        'path',
        'description'
    ];

    public function Customer() {
        return $this->belongsTo(Customer::class, "customer_id");
    }

    public function selectData(){
        return [
            'customers.name as customer_name',
            'customers_files.description',
            'customers_files.path',
            'customers_files.id as key_id'
        ];
    }

     public function dataTableQuery(){
        return self::where("customers_files.id", "<>", 0)
            ->join("customers", "customers.id", "customers_files.customer_id")
        ;
    }

}
