<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PcAsset extends Model
{
    use HasFactory;

   
    protected $table = 'pc_assets';

   
    protected $fillable = [
        'nomor_aset',
        'nama_departemen',
        'tipe_perangkat',
        'merk_spesifikasi',
        'nomor_seri',
        'status_kondisi',
        'created_by',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    
    public const TIPE_PERANGKAT = ['PC Desktop', 'Laptop', 'All-in-One PC', 'Workstation'];
    public const STATUS_KONDISI = ['Baik', 'Rusak Ringan', 'Rusak Berat', 'Dalam Perbaikan'];

    
    public const SARAN_DEPARTEMEN = ['HRD', 'Finance', 'Operasional', 'IT', 'Marketing'];

    
    public function getBadgeStatusAttribute(): string
    {
        return match ($this->status_kondisi) {
            'Baik'            => 'success',
            'Rusak Ringan'    => 'warning',
            'Rusak Berat'     => 'danger',
            'Dalam Perbaikan' => 'info',
            default           => 'secondary',
        };
    }
}
