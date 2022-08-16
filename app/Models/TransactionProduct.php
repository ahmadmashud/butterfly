<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionProduct extends Model
{
    use HasFactory;
    protected $table = 't_transaction_products';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'id_produk');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class,'id_trx','id');
    }
}
