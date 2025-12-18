<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kondisi extends Model
{
    use HasFactory;

    protected $table = 'kondisi_barang';
    protected $guarded = [];
    
    public function kondisis()
    {
        return $this->hasMany(Barang::class, 'kondisi_id');
    }
}
