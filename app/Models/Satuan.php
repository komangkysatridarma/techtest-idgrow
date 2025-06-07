<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    protected $table = 'satuans';
    protected $guarded = ['id'];

    public function produks()
    {
        return $this->hasMany(Produk::class);
    }
}
