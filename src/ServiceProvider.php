<?php

namespace Guysolamour\Administrable\Extensions\Mailbox;

use Illuminate\Support\Str;


class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    const PACKAGE_NAME = 'administrable-mailbox';

    public function boot()
    {
        $this->publishes([
            static::packagePath("config/" . self::PACKAGE_NAME . ".php") => config_path(self::PACKAGE_NAME . '.php'),
        ], self::PACKAGE_NAME . '-config');

        $this->publishes([
            static::packagePath('resources/lang') => resource_path('lang/vendor/' . static::PACKAGE_NAME),
        ], static::PACKAGE_NAME . '-lang');

        $this->loadRoutesFrom(static::packagePath("/routes/back.php"));
        $this->loadRoutesFrom(static::packagePath("/routes/front.php"));

        $this->loadTranslationsFrom(static::packagePath('resources/lang'), static::PACKAGE_NAME);

        $this->loadMigrationsFrom([
            config(self::PACKAGE_NAME . '.migrations_path'),
        ]);

        $this->loadViewsFrom(static::packagePath('/resources/views/front'), self::PACKAGE_NAME);
        $this->loadViewsFrom(static::packagePath('/resources/views/back/' . Str::lower(config('administrable.theme'))), self::PACKAGE_NAME);
        $this->loadViewsFrom($this->packagePath('/resources/views/emails'), self::PACKAGE_NAME);
    }

    public function register()
    {
        $this->mergeConfigFrom(
            static::packagePath('config/' . self::PACKAGE_NAME . '.php'),
            self::PACKAGE_NAME
        );
    }

    public static function packagePath(string $path = ''): string
    {
        return  __DIR__ . '/../' . $path;
    }
}
