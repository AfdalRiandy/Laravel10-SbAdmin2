<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shop_name',
        'phone',
        'nis',
        'kelas',
        'jurusan',
        'alamat_toko',
        'deskripsi_toko',
        'status_verifikasi',
        'selfie_photo',
        'shop_photo',
        'guru_pendamping_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function guruPendamping()
    {
        return $this->belongsTo(User::class, 'guru_pendamping_id');
    }
}
