<?php

namespace App\Models;

use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionExtend extends Permission
{
    /**
     * Delete the permission and detach all related roles.
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete()
    {
        \DB::beginTransaction();

        try {
            \DB::table('model_has_permissions')
                ->where('permission_id', $this->id)
                ->delete();

            \DB::table('role_has_permissions')
                ->where('permission_id', $this->id)
                ->delete();

            \DB::table('permissions')
                ->where('id', $this->id)
                ->delete();

            \DB::commit();

        } catch (\Exception $e) {
            \DB::rollback();
            throw $e;
        }
    }
}
