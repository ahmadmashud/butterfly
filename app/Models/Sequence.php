<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sequence extends Model
{
    use HasFactory;
    protected $table = 'm_sequences';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
