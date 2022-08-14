<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomisiSupplier extends Model
{
    use HasFactory;
    protected $table = 't_komisi_suppliers';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function supplier()
    {
        return $this->hasOne(Supplier::class, 'id', 'id_supplier');
    }


    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'id_trx', 'id');
    }
}
