<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function laborTransactions()
    {
        return $this->hasMany(LaborTransaction::class);
    }

    public function partsReplacementTransactions()
    {
        return $this->hasMany(PartsReplacementTransaction::class);
    }
}
