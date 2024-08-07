<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GasolineStation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function petroleumProducts()
    {
        return $this->hasMany(PetroleumProduct::class);
    }

}
