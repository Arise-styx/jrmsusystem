<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function leavetype()
    {
        return $this->belongsTo(LeaveTypes::class);
    }

    public function leaveApproval()
    {
        return $this->hasMany(LeaveApproval::class, 'leave_id');
    }

    public function hasBeenApprovedBy(Employee $employee)
    {
        return $this->leaveApproval()->where('employee_id', $employee->employee_id)->exists();
    }

    public function hasApprovalByNotedBy(Employee $employee)
    {
        return $this->leaveApproval()
                    ->where('employee_id', $employee->employee_id)
                    ->where('approval_type', 'Noted By')
                    ->exists();
    }

    // public function isStatusDismissedForUser($userId)
    // {
    //     foreach ($this->leaveApproval as $approval) {
    //         if ($approval->status == 'dismissed' && $approval->approval == $userId) {
    //             return true;
    //         }
    //     }
    //     return false;
    // }
    public function hasStatusDismissedForUser($userId)
    {
        // Get the approved records for this leave
        $approvedRecords = $this->leaveApproval;

        // Check if any record has 'dismissed' status and matches the given user ID
        return $approvedRecords->contains(function ($approval) use ($userId) {
            return $approval->status == 'dismissed' && $approval->approval == $userId;
        });
    }
    // public function GMhasStatusDismissedForUser()
    // {
    //     // Get the approved records for this leave
    //     $approvedRecords = $this->LeaveRequest;

    //     // Check if any record has 'dismissed' status and matches the given user ID
    //     return $approvedRecords->contains(function ($id) {
    //         return $id->status == 'dismissed';
    //     });
    // }
}
