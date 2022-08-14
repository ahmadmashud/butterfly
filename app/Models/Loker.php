<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loker extends Model
{
    use HasFactory;
    protected $table = 'm_lokers';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
