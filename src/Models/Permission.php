<?php

namespace Novius\Backpack\PermissionManager\Models;

use Backpack\PermissionManager\app\Models\Permission as OriginalPermission;

class Permission extends OriginalPermission
{
    /**
     * Gets the permission prefix (eg. admin.page)
     *
     * @return null|string
     */
    public function prefix()
    {
        if (! str_contains($this->name, '::')) {
            return;
        }

        list($prefix) = explode('::', $this->name);

        return $prefix;
    }

    /**
     * Gets the permission item (eg. list, create, update...)
     *
     * @return string
     */
    public function item()
    {
        return str_after($this->name, '::');
    }
}
