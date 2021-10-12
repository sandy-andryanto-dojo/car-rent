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

class CustomerContact extends Model implements Auditable {

    use DataTable,
        \OwenIt\Auditing\Auditable;

    protected $dates = ['deleted_at'];
    protected $table = 'customers_contacts';
    protected $fillable = [
        'customer_id',
        'image',
        'name',
        'gender',
        'email',
        'phone',
        'mobile',
        'postal_code',
        'fax_number',
        'address'
    ];

    public function Customer() {
        return $this->belongsTo(Customer::class, "customer_id");
    }

    public function selectData(){
        return [
            'customers.name as customer_name',
            'customers_contacts.name',
            'customers_contacts.gender',
            'customers_contacts.email',
            'customers_contacts.phone',
            'customers_contacts.address',
            'customers_contacts.id as key_id'
        ];
    }

     public function dataTableQuery(){
        return self::where("customers_contacts.id", "<>", 0)
            ->join("customers", "customers.id", "customers_contacts.customer_id")
        ;
    }
    

}
