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
use App\Models\Car;


class Type extends Model implements Auditable{
    
    use SoftDeletes, DataTable, \OwenIt\Auditing\Auditable;

    protected $dates = ['deleted_at'];
    protected $table = 'types';
    protected $fillable = [
        'name',
        'description',
    ];

    public function Car(){
        return $this->hasMany(Car::class);
    }

    
    public function selectData(){
        return [
            'types.name as type_name',
            'types.description as type_description',
            'types.id as key_id'
        ];
    }

}
