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


class Status extends Model implements Auditable{
    
    use SoftDeletes, DataTable, \OwenIt\Auditing\Auditable;

    protected $dates = ['deleted_at'];
    protected $table = 'status';
    protected $fillable = [
        'name',
        'description',
    ];

    public function Car(){
        return $this->hasMany(Car::class);
    }

    public function selectData(){
        return [
            'status.name as status_name',
            'status.description as status_description',
            'status.id as key_id'
        ];
    }

}
