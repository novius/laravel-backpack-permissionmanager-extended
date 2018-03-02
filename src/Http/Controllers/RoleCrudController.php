<?php

namespace Novius\Backpack\PermissionManager\Http\Controllers;

use Backpack\PermissionManager\app\Http\Controllers\RoleCrudController as OriginalRoleCrudController;

class RoleCrudController extends OriginalRoleCrudController
{
    public function setup()
    {
        parent::setup();

        $this->crud->addColumn([
            // n-n relationship (with pivot table)
            'label'     => ucfirst(trans('backpack::permissionmanager.permission_plural')),
            'type'      => 'model_function',
            'function_name' => 'getCrudColumnPermissions', // the method in your Model
            'name'      => 'permissions', // the method that defines the relationship in your Model
            'entity'    => 'permissions', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'     => config('laravel-permission.models.permission'), // foreign key model
            'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
        ]);


//        'view'      => 'backpack-permission-extended::columns.permissions',

        $this->crud->addField([
            'label'     => '',
            'type'      => 'view',
            'view'      => 'backpack-permission-extended::fields.permissions',
            'name'      => 'permissions',
            'entity'    => 'permissions',
            'attribute' => 'name',
            'model'     => config('laravel-permission.models.permission'),
            'pivot'     => true,
        ]);
    }
}
