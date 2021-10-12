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
use App\Models\Identity;
use App\Models\CustomerContact;
use App\Models\CustomerFile;
use App\Models\Transaction;

class Customer extends Model implements Auditable {

    use SoftDeletes,
        DataTable,
        \OwenIt\Auditing\Auditable;

    protected $dates = ['deleted_at'];
    protected $table = 'customers';
    protected $fillable = [
        'identity_id',
        'image',
        'id_number',
        'code',
        'name',
        'gender',
        'email',
        'phone',
        'mobile',
        'postal_code',
        'fax_number',
        'address',
        'notes',
        'is_banned'
    ];

    public function Identity() {
        return $this->belongsTo(Identity::class, "identity_id");
    }

    public function CustomerContact() {
        return $this->hasMany(CustomerContact::class);
    }

    public function CustomerFile() {
        return $this->hasMany(CustomerFile::class);
    }

    public function Transaction() {
        return $this->hasMany(Transaction::class);
    }

    public function selectData(){
        return [
            'customers.code',
            'customers.name',
            'identities.name as identity_name',
            'customers.id_number',
            'customers.gender',
            'customers.phone',
            'customers.is_banned',
            'customers.id as key_id'
        ];
    }

     public function dataTableQuery(){
        return self::where("customers.id", "<>", 0)
            ->join("identities", "identities.id", "customers.identity_id")
        ;
    }

}
