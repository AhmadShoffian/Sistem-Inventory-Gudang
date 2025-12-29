<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'jumlah',
        'kategori_id',
        'satuan_id',
        'kondisi_id',
        'lokasi_id',
        'status_barang',
        'lampiran',
        'created_by_user_id',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
    
    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id');
    }
    
    public function kondisi()
    {
        return $this->belongsTo(Kondisi::class, 'kondisi_id');
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'lokasi_id');
    }
    
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

}
