<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fuels()
    {
        return $this->hasMany(Fuel::class);
    }

    public function leaveRequests()
    {
        return $this->hasMany(LeaveRequest::class);
    }

    public function approvals()
    {
        return $this->hasMany(LeaveApproval::class, 'employee_id');
    }

    public function leaveInfos()
    {
        return $this->hasMany(LeaveInfo::class, 'employee_id');
    }

    public function leaveProrateds()
    {
        return $this->hasMany(LeaveProrated::class);
    }
    protected $fillable = [
        'SLeave_balance',
        'VLeave_balance',
    ];

    protected $casts = [
        'SLeave_balance' => 'float',
        'VLeave_balance' => 'float',
    ];
}
