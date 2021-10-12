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
use App\Models\CarPenalty;


class TransactionPenalty extends Model implements Auditable{
    
    use SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $dates = ['deleted_at'];
    protected $table = 'transactions_penalties';
    protected $fillable = [
        'transaction_id',
        'penalty_id',
        'name',
        'description',
        'charge'
    ];

    public function Transaction() {
        return $this->belongsTo(Transaction::class, "transaction_id");
    }

    public function Penalty() {
        return $this->belongsTo(CarPenalty::class, "penalty_id");
    }

}
