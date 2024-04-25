<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    protected $table = 'indonesia_districts';
	protected $guarded = [];
    
    public function desa()
    {
        return $this->hasMany(Desa::class, 'code', 'district_code');
    }
}
