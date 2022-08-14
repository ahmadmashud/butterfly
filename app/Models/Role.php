<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'm_roles';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function privilege()
    {
        return $this->hasMany(RolePrivilege::class, 'id_role', 'id');
    }
}
