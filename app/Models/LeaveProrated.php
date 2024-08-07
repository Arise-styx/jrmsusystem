<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveProrated extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Define relationships if any
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
