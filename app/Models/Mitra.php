<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_id', 'code');
    }
    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id', 'code');
    }
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id', 'code');
    }
    public function desa()
    {
        return $this->belongsTo(Desa::class, 'desa_id', 'code');
    }
}
