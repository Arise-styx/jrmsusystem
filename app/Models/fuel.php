<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fuel extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approvals()
    {
        return $this->belongsToMany(User::class, 'approval_for_fuel_requests');
    }

    public function hasBeenApprovedBy(User $user)
    {
        return $this->approvals()->where('user_id', $user->id)->exists();
    }

    public function isFullyApproved()
    {
        // Adjust the condition as needed based on your business logic
        return $this->approvals()->count() >= 4;/* number of required approvals */;
    }

    public function hasCorplanApproved()
    {
        // Get the approved users for this fuel request
        $approvedUsers = $this->approvals;

        // Check if any corplan user exists among the approved users
        return $approvedUsers->contains(function ($user) {
            return $user->roles()->where('name', 'corplan')->exists();
        });
    }

    // public function hasFORApproved($role)
    // {
    //     return $this->approvals->contains(function ($user) use ($role) {
    //         return $user->roles()->where('name', $role)->exists();
    //     });
    // }

    public function isRejected($fuelId)
    {
        // Check if there exists an approval entry with 'Rejected' status for the given fuel ID
        return Fuel::where('id', $fuelId)
            ->where('status', 'Rejected')
            ->exists();
    }

    public function employee_object()
    {
        return $this->belongsTo(Employee::class);
    }

}
