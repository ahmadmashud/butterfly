<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryFoodDrink extends Model
{
    use HasFactory;
    protected $table = 'm_category_food_drinks';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
