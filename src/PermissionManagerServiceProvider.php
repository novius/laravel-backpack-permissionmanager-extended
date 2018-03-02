<?php

namespace Novius\Backpack\PermissionManager;

use Backpack\PermissionManager\PermissionManagerServiceProvider as OriginalPermissionManagerServiceProvider;

class PermissionManagerServiceProvider extends OriginalPermissionManagerServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
