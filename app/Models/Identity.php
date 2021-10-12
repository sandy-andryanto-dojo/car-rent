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
use App\Models\Customer;
use App\Models\Driver;


class Identity extends Model implements Auditable{
    
    use SoftDeletes, DataTable, \OwenIt\Auditing\Auditable;

    protected $dates = ['deleted_at'];
    protected $table = 'identities';
    protected $fillable = [
        'name',
        'description',
    ];

    public function Customer() {
        return $this->hasMany(Customer::class);
    }

    public function Driver() {
        return $this->hasMany(Driver::class);
    }

    public function selectData(){
        return [
            'identities.name as identity_name',
            'identities.description as identity_description',
            'identities.id as key_id'
        ];
    }

}
