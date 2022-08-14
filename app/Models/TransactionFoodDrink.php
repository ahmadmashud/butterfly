<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionFoodDrink extends Model
{
    use HasFactory;
    protected $table = 't_transaction_food_drinks';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function foodDrink()
    {
        return $this->hasOne(FoodDrink::class, 'id', 'id_food_drink');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class,'id_trx','id');
    }
}
