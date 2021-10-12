<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as LaravelModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Traits\DataTable;
// Relations
use App\Models\Brand;
use App\Models\Model;
use App\Models\Status;
use App\Models\Type;
use App\Models\Fuel;
use App\Models\CarImage;
use App\Models\CarPenalty;

class Car extends LaravelModel implements Auditable {

    use SoftDeletes,
        DataTable,
        \OwenIt\Auditing\Auditable;

    protected $dates = ['deleted_at'];
    protected $table = 'cars';
    protected $fillable = [
        'brand_id',
        'model_id',
        'status_id',
        'type_id',
        'fuel_id',
        'color',
        'id_number',
        'year_established',
        'length',
        'width',
        'height',
        'capacity',
        'charge',
        'description',
        'notes',
        'is_rent'
    ];

    public function Brand(){
        return $this->belongsTo(Brand::class, "brand_id");
    }

    public function Model(){
        return $this->belongsTo(Model::class, "model_id");    
    }

    public function Status(){
        return $this->belongsTo(Status::class, "status_id");
    }

    public function Type(){
        return $this->belongsTo(Type::class, "type_id");
    }

    public function Fuel(){
        return $this->belongsTo(Fuel::class, "fuel_id");
    }
    
    public function CarImage() {
        return $this->hasMany(CarImage::class);
    }

    public function CarPenalty() {
        return $this->hasMany(CarPenalty::class);
    }

    public function selectData(){
        return [
            'cars.id_number',
            'cars.year_established',
            'brands.name as brand_name',
            'models.name as model_name',
            'status.name as status_name',
            'types.name as type_name',
            'fuels.name as fuel_name',
            'cars.is_rent',
            'cars.id as key_id'
        ];
    }

    public function dataTableQuery(){
        return self::where("cars.id", "<>", 0)
            ->join("brands", "brands.id", "cars.brand_id")
            ->join("models", "models.id", "cars.model_id")
            ->join("status", "status.id", "cars.status_id")
            ->join("types", "types.id", "cars.type_id")
            ->join("fuels", "fuels.id", "cars.fuel_id")
        ;
     }
}
