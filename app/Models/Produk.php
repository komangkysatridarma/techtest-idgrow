<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    use SoftDeletes;

    protected $table = 'produks';
    protected $guarded = ['id'];

    public function satuan()
    {
        return $this->belongsTo(Satuan::class);
    }

    public function kategori()
    {
        return $this->belongsTo(kategori::class);
    }

    public function produkLokasis()
    {
        return $this->hasMany(ProdukLokasi::class);
    }
}
