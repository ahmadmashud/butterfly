<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePrivilege extends Model
{
    use HasFactory;
    protected $table = 'm_role_privileges';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function privilege()
    {
        return $this->hasOne(Privilege::class, 'id', 'id_privilege');
    }
}
