<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;
    protected $table = 'indonesia_cities';
	protected $guarded = [];
    
    public function kecamatan()
    {
        return $this->hasMany(Kecamatan::class, 'code', 'city_code');
    }
}
