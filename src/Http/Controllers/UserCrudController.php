<?php

namespace Novius\Backpack\PermissionManager\Http\Controllers;

use Backpack\PermissionManager\app\Http\Controllers\UserCrudController as OriginalUserCrudController;

class UserCrudController extends OriginalUserCrudController
{
    public function setup()
    {
        parent::setup();

        // Columns.
        $this->crud->setColumns([
            [
                'name'  => 'name',
                'label' => trans('backpack::permissionmanager.name'),
                'type'  => 'text',
            ],
            [
                'name'  => 'email',
                'label' => trans('backpack::permissionmanager.email'),
                'type'  => 'email',
            ],
            [ // n-n relationship (with pivot table)
                'label'     => trans('backpack::permissionmanager.roles'), // Table column heading
                'type'      => 'select_multiple',
                'name'      => 'roles', // the method that defines the relationship in your Model
                'entity'    => 'roles', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model'     => config('laravel-permission.models.role'), // foreign key model
            ],
            [ // n-n relationship (with pivot table)
                'label'     => trans('backpack::permissionmanager.extra_permissions'), // Table column heading
                'type'      => 'view',
                'view'      => 'backpack-permission-extended::columns.permissions',
                'name'      => 'permissions', // the method that defines the relationship in your Model
                'entity'    => 'permissions', // the method that defines the relationship in your Model
                'attribute' => null, // foreign key attribute that is shown as the permission name (string, callback or null for default value)
                'model'     => config('laravel-permission.models.permission'), // foreign key model
                'inline'    => false, // true for all groups of permission on the same row or false for each on a row
            ],
        ]);

        // Fields
        $this->crud->addFields([
            [
                'name'  => 'name',
                'label' => trans('backpack::permissionmanager.name'),
                'type'  => 'text',
            ],
            [
                'name'  => 'email',
                'label' => trans('backpack::permissionmanager.email'),
                'type'  => 'email',
            ],
            [
                'name'  => 'password',
                'label' => trans('backpack::permissionmanager.password'),
                'type'  => 'password',
            ],
            [
                'name'  => 'password_confirmation',
                'label' => trans('backpack::permissionmanager.password_confirmation'),
                'type'  => 'password',
            ],
            [
                // two interconnected entities
                'label'             => false,
                'field_unique_name' => 'user_role_permission',
                'type'              => 'view',
                'view'              => 'backpack-permission-extended::fields.permissions_with_roles',
                'name'              => 'roles_and_permissions', // the methods that defines the relationship in your Model
                'subfields'         => [
                    'primary' => [
                        'label'            => trans('backpack::permissionmanager.roles'),
                        'name'             => 'roles', // the method that defines the relationship in your Model
                        'entity'           => 'roles', // the method that defines the relationship in your Model
                        'entity_secondary' => 'permissions', // the method that defines the relationship in your Model
                        'attribute'        => null, // foreign key attribute that is shown to user (string, callback or null for default value)
                        'model'            => config('laravel-permission.models.role'), // foreign key model
                        'pivot'            => true, // on create&update, do you need to add/delete pivot table entries?]
                        'columns'          => true, // Number of columns (1,2,3,4,6) or "true" for all on same line or "false" for each on a single line
                    ],
                    'secondary' => [
                        'label'          => ucfirst(trans('backpack::permissionmanager.permission_singular')),
                        'name'           => 'permissions', // the method that defines the relationship in your Model
                        'entity'         => 'permissions', // the method that defines the relationship in your Model
                        'entity_primary' => 'roles', // the method that defines the relationship in your Model
                        'attribute'      => null, // foreign key attribute that is shown to user (string or callback)
                        'model'          => config('laravel-permission.models.permission'), // foreign key model
                        'pivot'          => true, // on create&update, do you need to add/delete pivot table entries?]
                    ],
                ],
            ],
        ]);
    }
}
