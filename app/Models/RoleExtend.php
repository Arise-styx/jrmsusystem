<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleExtend extends Role
{
    /**
     * Delete the role and detach all related permissions and users.
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete()
    {
        \DB::beginTransaction();

        try {
            \DB::table('model_has_roles')
                ->where('role_id', $this->id)
                ->delete();

            \DB::table('role_has_permissions')
                ->where('role_id', $this->id)
                ->delete();

            \DB::table('roles')
                ->where('id', $this->id)
                ->delete();

            \DB::commit();

        } catch (\Exception $e) {
            \DB::rollback();
            throw $e;
        }
    }
}
