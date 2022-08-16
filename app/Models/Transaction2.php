<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction2 extends Model
{
    use HasFactory;
    protected $table = 't_transactions2';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function transaction()
    {
        return $this->hasOne(Transaction::class, 'id', 'id_trx');
    }
}
