<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPeriksa extends Model
{
    protected $table = 'jadwal_periksas';
    protected $guarded = ['id'];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class,'id_dokter','id');
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli'); // Hubungkan id_poli dengan model Poli
    }

    // Relasi dengan daftar poli (tabel daftar_poli)
    public function daftarPoli()
    {
        return $this->hasMany(DaftarPoli::class, 'id_jadwal');
    }
}
