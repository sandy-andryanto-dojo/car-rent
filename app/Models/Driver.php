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
use App\Models\Transaction;

class Driver extends Model implements Auditable {

    use SoftDeletes,
        DataTable,
        \OwenIt\Auditing\Auditable;

    protected $dates = ['deleted_at'];
    protected $table = 'drivers';
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
        'is_ready'
    ];

    public function Identity() {
        return $this->belongsTo(Identity::class, "identity_id");
    }

    public function Transaction() {
        return $this->hasMany(Transaction::class);
    }

    public function selectData(){
        return [
            'drivers.code',
            'drivers.name',
            'identities.name as identity_name',
            'drivers.id_number',
            'drivers.gender',
            'drivers.phone',
            'drivers.is_ready',
            'drivers.id as key_id'
        ];
    }

     public function dataTableQuery(){
        return self::where("drivers.id", "<>", 0)
            ->join("identities", "identities.id", "drivers.identity_id")
        ;
    }

}
