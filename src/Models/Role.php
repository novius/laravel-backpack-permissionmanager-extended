<?php

namespace Novius\Backpack\PermissionManager\Models;

use Backpack\PermissionManager\app\Models\Role as OriginalRole;

class Role extends OriginalRole
{
    public function getCrudColumnPermissions()
    {
        return view('backpack-permission-extended::columns.permissions', [
            'entry' => $this,
            'column' => [
                'label'         => ucfirst(trans('backpack::permissionmanager.permission_plural')),
                'name'          => 'permissions',
                'entity'        => 'permissions',
                'attribute'     => 'name',
                'model'         => config('laravel-permission.models.permission'),
                'pivot'         => true,
            ],
        ]);
    }
}
