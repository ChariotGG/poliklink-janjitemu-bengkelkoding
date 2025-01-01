<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    protected $table = 'polis';
    protected $guarded = ['id'];
    // Poli.php (Model)
public function dokter()
{
    return $this->hasMany(Dokter::class, 'id'); // jika ingin memanggil semua dokter dari poli tertentu
}

}


