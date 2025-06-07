<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdukLokasi extends Model
{
    use SoftDeletes;

    protected $table = 'produk_lokasis';
    protected $guarded = ['id'];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class);
    }

    public function mutasis()
    {
        return $this->hasMany(Mutasi::class);
    }
}
