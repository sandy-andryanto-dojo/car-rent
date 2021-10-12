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
use App\Models\TransactionService;


class Service extends Model implements Auditable{
    
    use SoftDeletes, DataTable, \OwenIt\Auditing\Auditable;

    protected $dates = ['deleted_at'];
    protected $table = 'services';
    protected $fillable = [
        'name',
        'description',
        'charge'
    ];

    public function TransactionService() {
        return $this->hasMany(TransactionService::class);
    }

    public function selectData(){
        return [
            'services.name as service_name',
            'services.charge as service_charge',
            'services.description as service_description',
            'services.id as key_id'
        ];
    }

}
