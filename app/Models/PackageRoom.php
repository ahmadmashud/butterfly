<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageRoom extends Model
{
    use HasFactory;
    protected $table = 'm_package_rooms';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
