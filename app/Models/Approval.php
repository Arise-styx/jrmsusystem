<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;

    protected $table = 'approval_for_fuel_requests';

    protected $fillable = [
        // 'fuel_request_id', // Foreign key to reference the fuel request
        // 'user_id', // Foreign key to reference the user who approved
        // 'status', // Status of the approval (e.g., 'Approved', 'Rejected')
        'fuel_id',
        'user_id',
        'approval_for',

    ];

    // Define relationships
    public function fuelRequest()
    {
        return $this->belongsTo(Fuel::class, 'fuel_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    // public static function approveFuelRequest($fuelId, $forEmployee)
    public static function approveFuelRequest($fuelId)
    {
        $fuel = Fuel::findOrFail($fuelId);

        // get the user
        $auth_user_roles = auth()->user()->getRoleNames();
        $user_roles = $auth_user_roles->filter(function ($role) {
            return $role !== 'department-heads' && $role !== 'reg-user';
        });

        $role = $user_roles->first();

        // dd($role);

        // dd($authenticateduser->getRoleNames());
        // Check if the current user has already approved the request
        if ($fuel->hasBeenApprovedBy(auth()->user())) {
            return false; // Already approved by this user
        }

        // Check if the user is authorized to approve fuel requests
        if (!auth()->user()->hasPermissionTo('approve fuel request')) {
            // Alternatively, you could throw an exception here
            return false; // User is not authorized to approve fuel requests
        }

        // Record the approval
        $approval = new static();
        // if (empty($forEmployee)) {
        $approval->fuel_id = $fuelId;
        $approval->user_id = auth()->user()->id;
        $approval->approval_for = $role;
        $approval->save();
        // }
        // } else {
        //     $approval->fuel_id = $fuelId;
        //     $approval->user_id = auth()->user()->id;
        //     $approval->approval_for = $role;
        //     $approval->save();
        // }

        // Check if all required approvals have been obtained
        if ($fuel->isFullyApproved()) {
            $fuel->update(['status' => 'approved']);
        }

        return true; // Approval successful

        return false; // User is not authorized to approve fuel requests
    }

    public function rejectFuelRequest($fuelId)
    {
        // Find the fuel request by ID
        $fuel = Fuel::findOrFail($fuelId);

        // Here, we'll just set a status column to 'Rejected'
        $fuel->status = 'rejected';

        // Save the changes to the fuel request
        return $fuel->save();
    }


    // public static function getApprovingUser($fuelId)
    // {
    //     // Find the approval record by fuel_id
    //     $approval = static::where('fuel_id', $fuelId)->first();

    //     // If an approval exists, return the user who approved it
    //     if ($approval) {
    //         return $approval->user;
    //     }

    //     // If no approval is found, return null or throw an exception
    //     return null;
    // }

}
