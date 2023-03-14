<?php

namespace NSWDPC\Waratah\Services\Analytics;

use SilverStripe\Core\Config\Configurable;
use SilverStripe\ORM\FieldType\DBHTMLText;
use SilverStripe\View\Requirements;

/**
 * GA3 implementation
 * @author James
 */
class GA3 extends AbstractAnalyticsService {

    /**
     * Return a string value for the implementation
     */
    public static function getCode() : string {
        return "GA3";
    }

    /**
     * @inheritdoc
     */
    public static function getDescription() : string {
        return _t('nswds.GOOGLE_ANALYTICS_3', 'Google Analytics v3 (analytics.js)');
    }

    /**
     * Add requirements or similar to the current request
     */
    public function provide(string $code = '') : ?DBHTMLText {
        $code = json_encode(htmlspecialchars($code));
        $script =
<<<JAVASCRIPT
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
ga('create', {$code}, 'auto');
ga('send', 'pageview');
JAVASCRIPT;

        if($script = parent::applyNonce($script)) {
            return $script;
        } else {
            return null;
        }
    }
}
