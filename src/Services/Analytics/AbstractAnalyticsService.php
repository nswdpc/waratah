<?php

namespace NSWDPC\Waratah\Services\Analytics;

use SilverStripe\Core\ClassInfo;
use SilverStripe\Core\Config\Configurable;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\FieldType\DBHTMLText;
use SilverStripe\View\HTML;
use SilverStripe\View\Requirements;
use NSWDPC\Utilities\ContentSecurityPolicy\Nonce;

/**
 * Provides an abstract implementation for analytics services
 * @author James
 */
abstract class AbstractAnalyticsService {

    use Configurable;

    /**
     * Return a string value for the implementation unique identifier
     */
    abstract public static function getCode() : string;

    /**
     * Return a string value to describe to a CMS admin what this does
     */
    abstract public static function getDescription() : string;

    /**
     * Add requirements or similar to the current request, return template variable
     * for inclusion in template, or null
     */
    abstract public function provide(string $code = '') : ?DBHTMLText;

    /**
     * Return an instance of the implementation based on the code provided
     */
    final public static function getImplementation(string $code) : ?AbstractAnalyticsService {
        $implementations = ClassInfo::subclassesFor( AbstractAnalyticsService::class, false);
        foreach($implementations as $implementation) {
            if($implementation::getCode() == $code) {
                $implementation = Injector::inst()->get( $implementation );
                return $implementation;
            }
        }
        return null;
    }

    /**
     */
    final public static function getImplementations() : array {
        $implementations = ClassInfo::subclassesFor( AbstractAnalyticsService::class, false);
        $selections = [];
        foreach($implementations as $implementation) {
            $selections[ $implementation::getCode() ] = $implementation::getDescription();
        }
        asort($selections);
        return $selections;
    }

    /**
     * Try to apply a nonce to a script
     */
    final public function applyNonce(string $script, $attributes = []) : DBHTMLText {
        if(class_exists(Nonce::class) && ($nonce = Nonce::getNonce())) {
            $attributes['nonce'] = $nonce;
        }
        $html = HTML::createTag(
            'script',
            $attributes,
            trim($script) // the script contents
        );
        return DBField::create_field( DBHTMLText::class, $html);

    }
}
