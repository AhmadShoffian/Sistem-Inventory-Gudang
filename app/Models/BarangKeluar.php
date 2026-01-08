<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BarangKeluar extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = ['kode_transaksi', 'tanggal_keluar', 'barang_id', 'jumlah_keluar', 'customer_id', 'satuan_id', 'created_by_user_id'];
    protected $guarded = [''];
    protected $ignoreChangedAttributes = ['updated_at'];

    public function getActivitylogAttributes(): array
    {
        return array_diff($this->fillable, $this->ignoreChangedAttributes);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logUnguarded()
            ->logOnlyDirty();
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }
}
