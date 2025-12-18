<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Satuan extends Model
{
    use HasFactory;

    protected $table = 'satuan_barang';
    protected $guarded = [];
    
    public function satuans()
    {
        return $this->hasMany(Barang::class, 'satuan_id');
    }
}
