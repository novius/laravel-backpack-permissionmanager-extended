# Backpack Permission Manager Extended

This package extends [Backpack/PermissionManager](https://github.com/Laravel-Backpack/PermissionManager). See all features added bellow.

## Installation

In your terminal:

```sh
composer require novius/laravel-backpack-permissionmanager-extended
```

Then, if you are on Laravel 5.4 (no need for Laravel 5.5 and higher), register the service provider to your `config/app.php` file :

In `config/app.php`, replaces

```php?start_inline=1
Backpack\PermissionManager\PermissionManagerServiceProvider::class,
```

by

```php?start_inline=1
Novius\Backpack\PermissionManager\PermissionManagerServiceProvider::class,
```

## Configuration

This package provides a configuration file whose values overwrite the configuration of `Backpack\PermissionManager`.

You can publish the configuration file if you want to change these values :
```
php artisan vendor:publish --provider="Novius\Backpack\PermissionManager\PermissionManagerServiceProvider" --tag=config
```

You can also publish the views, lang and routes :
```
php artisan vendor:publish --provider="Novius\Backpack\PermissionManager\PermissionManagerServiceProvider" --tag=views
php artisan vendor:publish --provider="Novius\Backpack\PermissionManager\PermissionManagerServiceProvider" --tag=lang
php artisan vendor:publish --provider="Novius\Backpack\PermissionManager\PermissionManagerServiceProvider" --tag=routes
```

## Features

* Improved interface to manage the roles and permissions on the user CRUD
* Improved interface to manage the permissions on the role CRUD

## Lint

Run php-cs with:

```sh
./cs.sh
```

## Contributing

Contributions are welcome!
Leave an issue on Github, or create a Pull Request.

## Licence

This package is under [GNU Affero General Public License v3](http://www.gnu.org/licenses/agpl-3.0.html) or (at your option) any later version.
