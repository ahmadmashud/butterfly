<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomisiTerapis extends Model
{
    use HasFactory;
    protected $table = 't_komisi_terapis';
    protected $guarded = ['id', 'created_at', 'updated_at'];
       
    public function terapis()
    {
        return $this->hasOne(Terapis::class, 'id', 'id_terapis');
    }
    

    public function transaction()
    {
        return $this->belongsTo(Transaction::class,'id_trx','id');
    }
}
