<?php

namespace Novius\Backpack\PermissionManager\Http\Controllers;

use Backpack\PermissionManager\app\Http\Controllers\UserCrudController as OriginalUserCrudController;

class UserCrudController extends OriginalUserCrudController
{
    public function setup()
    {
        parent::setup();

        // Columns
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
            [
                'label'     => trans('backpack::permissionmanager.roles'),
                'type'      => 'select_multiple',
                'name'      => 'roles',
                'entity'    => 'roles',
                'attribute' => 'name',
                'model'     => config('laravel-permission.models.role'),
            ],
            [
                'label'     => trans('backpack::permissionmanager.extra_permissions'),
                'type'      => 'select_multiple',
                'name'      => 'permissions',
                'entity'    => 'permissions',
                'attribute' => 'name',
                'model'     => config('laravel-permission.models.permission'),
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
                'label'             => false,
                'field_unique_name' => 'user_role_permission',
                'type'              => 'view',
                'view'              => 'backpack-permissionmanager-extended::fields.permissions_with_roles',
                'name'              => 'roles_and_permissions',
                'subfields'         => [
                    'primary' => [
                        'label'            => trans('backpack::permissionmanager.roles'),
                        'name'             => 'roles',
                        'entity'           => 'roles',
                        'entity_secondary' => 'permissions',
                        'attribute'        => null,
                        'model'            => config('laravel-permission.models.role'),
                        'pivot'            => true,
                        'columns'          => true,
                    ],
                    'secondary' => [
                        'label'          => ucfirst(trans('backpack::permissionmanager.permission_singular')),
                        'name'           => 'permissions',
                        'entity'         => 'permissions',
                        'entity_primary' => 'roles',
                        'attribute'      => null,
                        'model'          => config('laravel-permission.models.permission'),
                        'pivot'          => true,
                    ],
                ],
            ],
        ]);
    }
}
