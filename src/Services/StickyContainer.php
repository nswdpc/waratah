<?php

namespace NSWDPC\Waratah\Services;

use NSWDPC\ExitButton\Models\ExitButton;
use SilverStripe\Core\Injector\Injectable;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Core\Extensible;
use SilverStripe\View\TemplateGlobalProvider;

/**
 * Templates can call $HasStickyContainer
 * If true, the template should apply whatever is required to implement the sticky containe
 * e.g. quick exit, cookie container component
 */
class StickyContainer implements TemplateGlobalProvider
{

    use Injectable;
    use Extensible;

    /**
     * Return a boolean value to flag that the StickContainer
     * should be applied to a page
     */
     public static function has_sticky_container(): bool
     {
        $has = false;
        // Test whether ExitButton implementation is available
        if(\class_exists(ExitButton::class)) {
            $has = ExitButton::has_global_exit_button();
        }

        // allow project code to override this
        Injector::inst()->get(self::class)->extend('hasStickyContainer', $has);
        return (bool) $has;
     }

     /**
      * @inheritdoc
      */
     public static function get_template_global_variables()
     {
         return [
             'HasStickyContainer' => 'has_sticky_container'
         ];
     }
}
