<?php

namespace Guysolamour\Administrable\Extensions\Mailbox\Console\Commands;

use Guysolamour\Administrable\Console\Extension\BaseExtension;
use Guysolamour\Administrable\Extensions\Mailbox\ServiceProvider;

class InstallExtensionCommand extends BaseExtension
{
    public function run()
    {
        if ($this->checkifExtensionHasBeenInstalled()) {
            $this->triggerError("The [{$this->name}] extension has already been added, remove all generated files and run this command again!");
        }

        $this->loadMigrations();

        $this->loadControllers();
        $this->loadSeeders();
        $this->loadViews();
        $this->runMigrateArtisanCommand();

        $this->displayMessage("{$this->name} extension added successfully.");

        // gérer la cas du header the admin
    }

    protected function getHeaderFrontUrlRoute(): string
    {
        return 'create';
    }


    protected function getExtensionsStubsBasePath(string $path = '')
    {
        return dirname(ServiceProvider::packagePath(), 2) . DIRECTORY_SEPARATOR . $path;
    }

}
