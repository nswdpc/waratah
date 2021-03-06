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
 */
class DesignSystemAssetExtension extends Extension {

    /**
     * @var DesignSystemConfiguration|null
     */
    private $configurator = null;

    /**
     * Include the Design System after controller init
     * Note that some modules call controller->init(), so need to check here that the current
     * controller actually has this class as an extension
     */
    public function onAfterInit()
    {
        if(!Controller::curr()->hasExtension(DesignSystemAssetExtension::class)) {
            return;
        }
        if(!$this->getConfigurationValue('frontend_provided')) {
            $this->requireDesignSystem();
        }
    }

    /**
     * Get the configuration model
     */
    final protected function getConfigurator() : DesignSystemConfiguration {
        if(!$this->configurator) {
            $this->configurator = new DesignSystemConfiguration();
        }
        return $this->configurator;
    }

    /**
     * Get the config value for a key
     * @return mixed
     */
    final protected function getConfigurationValue(string $key) {
        return $this->getConfigurator()->config()->get($key);
    }

    /**
     * Return DS asset path in the format required for the Requirements API
     * @throws \Exception
     */
    protected function getAsset(string $asset) : string {
        $vendor = $this->getConfigurationValue('vendor');
        $module = $this->getConfigurationValue('module');
        $theme = $this->getConfigurationValue('theme');
        if($vendor && $module && $theme) {
            // Silverstripe vendormodule theme
            return $vendor
             . "/"
             . $module
             . ":"
             . "themes/" . $theme
             . "/" . ltrim($asset, "/");
         } else if($theme) {
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
    protected function requireFonts() {

        Requirements::css(
            "https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,400;0,700;1,400&display=swap",
            "screen"
        );

        Requirements::css(
            "https://fonts.googleapis.com/icon?family=Material+Icons&display=block",
            "screen"
        );

    }

    /**
     * Require the built assets
     */
    protected function requireDesignSystem() : void {

        // JS loads prior to </body>
        Requirements::set_force_js_to_bottom(true);

        // Block modules providing these common jQuery assets
        // TODO check requirements and block external jquery found via pattern?
        Requirements::block("//code.jquery.com/jquery-3.3.1.min.js");
        Requirements::block("//code.jquery.com/jquery-3.4.1.min.js");
        Requirements::block("//code.jquery.com/jquery-3.5.1.min.js");
        Requirements::block("https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js");
        Requirements::block("https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js");
        Requirements::block("https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js");
        Requirements::block('silverstripe/userforms:client/dist/js/jquery.min.js');

        // Require jQuery latest
        Requirements::javascript(
            "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js",
            [
                "integrity" => "sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==",
                "crossorigin" => "anonymous"
            ]
        );

        $this->requireFonts();

        // The built NSW DS CSS, with supporting CSS
        if(Director::isLive()) {
            Requirements::css(
                $this->getAsset("app/frontend/dist/css/app.min.css"),
                "screen"
            );
        } else {
            Requirements::css(
                $this->getAsset("app/frontend/dist/css/app.css"),
                "screen"
            );
        }

        // The built NSWDS,  with supporting JS and window.NSW.initSite() called
        if(Director::isLive()) {
            Requirements::javascript(
                $this->getAsset("app/frontend/dist/js/app.min.js"),
                [
                    'async' => 'async'
                ]
            );
        } else {
            Requirements::javascript(
                $this->getAsset("app/frontend/dist/js/app.js"),
                [
                    'async' => 'async'
                ]
            );
        }

    }

    /**
     * Provide the current SVG sprite from the theme, called within the template
     * Note to load this as a relative path for a frontend asset:
     * <code>
     * Injector::inst()->get(ResourceURLGenerator::class)
     *             ->setNonceStyle(null)// do not add a ?m=
     *             ->urlForResource( $sprite )
     * </code>
     * @return string
     * @param bool $inline whether to include the SVG sprite inline as an <svg> tag
     */
    public function SVGSprite($inline = false) {
        try {

            if($inline) {

                $sprite = ThemeResourceLoader::inst()->findThemedResource(
                            "app/frontend/dist/assets/svg/sprite.svg",
                            SSViewer::get_themes()
                );
                if(!$sprite) {
                    throw new \Exception("No sprite found");
                }

                $path = Director::getAbsFile($sprite);
                if(!file_exists($path)) {
                    throw new \Exception("Sprite not found");
                }

                $dom = new \DOMDocument();
                $contents = $dom->loadXML( file_get_contents( $path ) );
                $html = trim($dom->saveHTML());
                if(!$html) {
                    return false;
                }

                Requirements::customCSS(
<<<CSS
.spritey {
    position: absolute;
    width: 0;
    height: 0;
    overflow: hidden;
}
CSS
                );
                return ArrayData::create([
                    'SVGSprite' => $html
                ])->renderWith('nswds/SVGSprite');

            } else {

                $sprite = ThemeResourceLoader::inst()->findThemedResource(
                            "app/frontend/dist/assets/svg/sprite.svg",
                            SSViewer::get_themes()
                );
                if(!$sprite) {
                    throw new \Exception("No sprite found");
                }

                $url = Injector::inst()->get(ResourceURLGenerator::class)
                        ->urlForResource( $sprite );

                // XHR method
                Requirements::customScript(
<<<JAVASCRIPT
var svgAjax = new XMLHttpRequest();
svgAjax.open("GET", "{$url}", true);
svgAjax.send();
svgAjax.onload = function(e) {
  var fragment = document.createRange().createContextualFragment(svgAjax.responseText);
  var svg = fragment.querySelector('svg')
  svg.setAttribute('aria-hidden', true);
  svg.style.cssText = 'position: absolute; width: 0; height: 0; overflow: hidden;'
  document.body.insertBefore(fragment, document.body.childNodes[0]);
};
JAVASCRIPT
                );
            }
        } catch (\Exception $e) {
            //noop
        }
        return "";
    }
}
