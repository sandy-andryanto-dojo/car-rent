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

class CarImage extends Model implements Auditable {

    use DataTable,
        \OwenIt\Auditing\Auditable;

    protected $dates = ['deleted_at'];
    protected $table = 'cars_images';
    protected $fillable = [
        'car_id',
        'path',
        'is_primary'
    ];

    public function Car(){
        return $this->belongsTo(Car::class, "car_id");
    }

    public function selectData(){
        return [
            'cars_images.path',
            'cars.id_number',
            'cars_images.is_primary',
            'cars_images.id as key_id',
        ];
    }

    public function dataTableQuery(){
        return self::where("cars_images.id", "<>", 0)
            ->join("cars", "cars.id", "cars_images.car_id")
        ;
    }

}
