<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terapis extends Model
{
    use HasFactory;
    protected $table = 'm_terapis';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
