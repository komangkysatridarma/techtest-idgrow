<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lokasi extends Model
{
    use SoftDeletes;

    protected $table = 'lokasis';
    protected $guarded = ['id'];

    public function produkLokasis()
    {
        return $this->hasMany(ProdukLokasi::class);
    }

    public function staff()
    {
        return $this->belongsToMany(User::class, 'staff_lokasi', 'lokasi_id', 'user_id');
    }
}
