<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomisiUser extends Model
{
    use HasFactory;
    protected $table = 't_komisi_users';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }
    
    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class,'id_trx','id');
    }
}
