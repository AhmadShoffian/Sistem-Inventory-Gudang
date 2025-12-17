<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestAkun extends Model
{
    use HasFactory;

    protected $table = 'requests';

    protected $fillable = [
        'nama',
        'nip',
        'jabatan',
        'unit_kerja',
        'email',
        'status',
    ];
}
