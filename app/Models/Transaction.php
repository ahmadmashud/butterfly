<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 't_transactions';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function loker()
    {
        return $this->hasOne(Loker::class, 'id', 'id_loker');
    }

    public function room()
    {
        return $this->hasOne(Room::class, 'id', 'id_room');
    }

    public function paket()
    {
        return $this->hasOne(PackageRoom::class, 'id', 'id_paket');
    }

    public function produk()
    {
        return $this->hasOne(Product::class, 'id', 'id_produk');
    }

    public function terapis()
    {
        return $this->hasOne(Terapis::class, 'id', 'id_terapis');
    }

    public function fnd()
    {
        return $this->hasMany(TransactionFoodDrink::class, 'id_trx', 'id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'id_transaction', 'id');
    }
}
