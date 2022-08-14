<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodDrink extends Model
{
    use HasFactory;

    protected $table = 'm_food_drinks';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function category()
    {
        return $this->hasOne(CategoryFoodDrink::class,'id','id_category_food_drink');
    }
}
