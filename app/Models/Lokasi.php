<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lokasi extends Model
{
    use HasFactory;

    protected $table = 'lokasi';
    protected $guarded = [];
    
    public function lokasis()
    {
        return $this->hasMany(Barang::class, 'lokasi_id');
    }
}
