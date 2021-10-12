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
// Relations
use App\Models\Transaction;
use App\Models\Service;

class TransactionService extends Model implements Auditable{
    
    use SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $dates = ['deleted_at'];
    protected $table = 'transactions_services';
    protected $fillable = [
        'transaction_id',
        'service_id',
        'name',
        'description',
        'charge'
    ];

    public function Transaction() {
        return $this->belongsTo(Transaction::class, "transaction_id");
    }

    public function Service() {
        return $this->belongsTo(Service::class, "service_id");
    }

}
