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
use App\Models\Car;
use App\Models\TransactionPenalty;

class CarPenalty extends Model implements Auditable {

    use DataTable,
        \OwenIt\Auditing\Auditable;

    protected $dates = ['deleted_at'];
    protected $table = 'cars_penalties';
    protected $fillable = [
        'car_id',
        'name',
        'description',
        'notes',
        'cost'
    ];

    public function Car(){
        return $this->belongsTo(Car::class, "car_id");
    }

    public function TransactionPenalty() {
        return $this->hasMany(TransactionPenalty::class);
    }

    public function selectData(){
        return [
            'cars.id_number',
            'cars_penalties.name',
            'cars_penalties.cost',
            'cars_penalties.description',
            'cars_penalties.notes',
            'cars_penalties.id as key_id'
        ];
    }

    public function dataTableQuery(){
        return self::where("cars_penalties.id", "<>", 0)
            ->join("cars", "cars.id", "cars_penalties.car_id")
        ;
     }

}
