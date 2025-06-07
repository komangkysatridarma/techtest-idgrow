<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mutasi extends Model
{
    use SoftDeletes;

    protected $table = 'mutasis';
    protected $guarded = ['id'];

    public function produkLokasi()
    {
        return $this->belongsTo(ProdukLokasi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
