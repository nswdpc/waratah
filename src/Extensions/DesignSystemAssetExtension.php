<?php

namespace NSWDPC\Waratah\Extensions;

use NSWDPC\Waratah\Models\DesignSystemConfiguration;
use SilverStripe\Control\Controller;
use SilverStripe\Control\Director;
use SilverStripe\Core\Config\Config;
use SilverStripe\Core\Extension;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Core\Manifest\ResourceURLGenerator;
use SilverStripe\View\ArrayData;
use SilverStripe\View\Requirements;
use SilverStripe\View\ThemeResourceLoader;
use SilverStripe\View\SSViewer;

/**
 * Provide NSW Design System asset requirement functionality
 * @author James
 * @extends \SilverStripe\Core\Extension<((\PageController & static) | (\SilverStripe\ShareDraftContent\Controllers\ShareDraftController & static))>
 */
class DesignSystemAssetExtension extends Extension
{
    private ?\NSWDPC\Waratah\Models\DesignSystemConfiguration $configurator = null;

    /**
     * Include the Design System after controller init (once)
     */
    public function onAfterInit()
    {
        if (!$this->getConfigurationValue('frontend_provided')) {
            $this->requireDesignSystem();
        }
    }

    /**
     * Get the configuration model
     */
    final protected function getConfigurator(): DesignSystemConfiguration
    {
        if (!$this->configurator) {
            $this->configurator = new DesignSystemConfiguration();
        }

        return $this->configurator;
    }

    /**
     * Get the config value for a key
     * @return mixed
     */
    final protected function getConfigurationValue(string $key)
    {
        return $this->getConfigurator()->config()->get($key);
    }

    /**
     * Return DS asset path in the format required for the Requirements API
     * @throws \Exception
     */
    protected function getAsset(string $asset): string
    {
        $vendor = $this->getConfigurationValue('vendor');
        $module = $this->getConfigurationValue('module');
        $theme = $this->getConfigurationValue('theme');
        if ($vendor && $module && $theme) {
            // Silverstripe vendormodule theme
            return $vendor
             . "/"
             . $module
             . ":"
             . "themes/" . $theme
             . "/" . ltrim($asset, "/");
        } elseif ($theme) {
            // Silverstripe theme
            return "themes/" . $theme
             . "/" . ltrim($asset, "/");
        } else {
            throw new \Exception("Invalid Design System configuration");
        }
    }

    /**
     * Require default font stack for the NSWDS
     * @return void
     */
    protected function requireFonts()
    {

        Requirements::css(
            "https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,400;0,700;1,400&display=swap"
        );

        Requirements::css(
            "https://fonts.googleapis.com/icon?family=Material+Icons&display=block"
        );

    }

    /**
     * Require the built assets
     */
    protected function requireDesignSystem(): void
    {

        // JS loads prior to </body>
        Requirements::set_force_js_to_bottom(true);

        if (Config::inst()->get(DesignSystemConfiguration::class, 'enable_jquery')) {
            static::requireJquery();
        }

        $this->requireFonts();

        // The built NSW DS CSS, with supporting CSS
        if (Director::isLive()) {
            Requirements::css(
                $this->getAsset("app/frontend/dist/css/app.min.css")
            );
        } else {
            Requirements::css(
                $this->getAsset("app/frontend/dist/css/app.css")
            );
        }

        // The built NSWDS,  with supporting JS and window.NSW.initSite() called
        if (Director::isLive()) {
            Requirements::javascript(
                $this->getAsset("app/frontend/dist/js/app.min.js"),
                [
                    'defer' => true
                ]
            );
        } else {
            Requirements::javascript(
                $this->getAsset("app/frontend/dist/js/app.js"),
                [
                    'defer' => true
                ]
            );
        }

    }

    /**
     * Handling for blocking know jquery versions and then requiring a specific version
     * @todo check requirements and block external jquery found via pattern?
     */
    public static function requireJquery()
    {

        Requirements::block("//code.jquery.com/jquery-3.3.1.min.js");
        Requirements::block("//code.jquery.com/jquery-3.4.1.min.js");
        Requirements::block("//code.jquery.com/jquery-3.5.1.min.js");
        Requirements::block("https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js");
        Requirements::block("https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js");
        Requirements::block("https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js");
        Requirements::block("https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js");
        Requirements::block("https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js");
        Requirements::block('silverstripe/userforms:client/dist/js/jquery.min.js');

        // Require jQuery
        Requirements::javascript(
            "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js",
            [
                "integrity" => "sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g",
                "crossorigin" => "anonymous"
            ]
        );
    }

}
