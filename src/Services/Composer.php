<?php

namespace NSWDPC\Waratah\Services;

use Composer\DependencyResolver\Operation\OperationInterface;
use Composer\DependencyResolver\Operation\InstallOperation;
use Composer\DependencyResolver\Operation\UpdateOperation;
use Composer\EventDispatcher\Event as BaseEvent;
use Composer\Script\Event as ScriptEvent;
use Composer\Installer\PackageEvent;

/**
 * Composer integration for this module
 * Can be used by composer to automatically build the DS via npm and gulp during install and update
 * Example: composer.json (at the project level)
 ```json
 "scripts": {
     "post-create-project-cmd": [
         "NSWDPC\\Waratah\\Services\\Composer::postCreateProject"
     ],
     "build-nswds": [
         "NSWDPC\\Waratah\\Services\\Composer::buildDesignSystem"
     ]
 }
 ```
 * @author James
 */
class Composer
{
    /**
     * Called via post-create-project-cmd
     * @phpstan-ignore class.notFound
     */
    public static function postCreateProject(ScriptEvent $event): bool
    {
        return self::buildDesignSystem($event);
    }

    /**
     * Execute the build script for the design system
     * Usage: `composer run-script build-nswds`
     * Gotcha: build.sh requires npm to be available on the host
     * @phpstan-ignore class.notFound
     */
    public static function buildDesignSystem(ScriptEvent $event = null): bool
    {
        $build = realpath(dirname(__FILE__) . "/../../build.sh");
        if ($build && file_exists($build) && is_executable($build)) {
            $cmd = escapeshellcmd($build);
            passthru($cmd, $output);
            return $output === 0;
        } else {
            print "build.sh not found, or is not executable\n";
            return false;
        }
    }
}
