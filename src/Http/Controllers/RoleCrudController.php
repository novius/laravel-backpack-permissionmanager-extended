<?php

namespace Novius\Backpack\PermissionManager\Http\Controllers;

use Backpack\PermissionManager\app\Http\Controllers\RoleCrudController as OriginalRoleCrudController;

class RoleCrudController extends OriginalRoleCrudController
{
    public function setup()
    {
        parent::setup();

        // Columns
        $this->crud->addColumn([
            'label' => ucfirst(trans('backpack::permissionmanager.permission_plural')),
            'type' => 'model_function',
            'function_name' => 'getCrudColumnPermissions',
            'name' => 'permissions',
            'entity' => 'permissions',
            'attribute' => 'name',
            'model' => config('laravel-permission.models.permission'),
            'pivot' => true,
        ]);

        // Fields
        $this->crud->addField([
            'label' => '',
            'type' => 'view',
            'view' => 'backpack-permissionmanager-extended::fields.permissions',
            'name' => 'permissions',
            'entity' => 'permissions',
            'attribute' => 'name',
            'model' => config('laravel-permission.models.permission'),
            'pivot' => true,
        ]);
    }
}
