<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveApproval extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function leaveRequest()
    {
        return $this->belongsTo(LeaveRequest::class, 'leave_id');
    }

    public function approver()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
