<?php

namespace NSWDPC\Waratah\Services\Analytics;

use SilverStripe\Core\Config\Configurable;
use SilverStripe\ORM\FieldType\DBHTMLText;
use SilverStripe\View\Requirements;

/**
 * GTM implementation
 * @author James
 */
class GTM extends AbstractAnalyticsService {

    /**
     * @inheritdoc
     */
    public static function getCode() : string {
        return "GTM";
    }

    /**
     * @inheritdoc
     */
    public static function getDescription() : string {
        return _t('nswds.GOOGLE_TAG_MANAGER', 'Google Tag Manager (gtm.js)');
    }

    /**
     * Add requirements or similar to the current request
     */
    public function provide(string $code = '') : ?DBHTMLText {
        $code = json_encode($code);
        $script =
<<<JAVASCRIPT
(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer', {$code});
JAVASCRIPT;
        // @var DBHTMLText
        if($script = parent::applyNonce($script)) {
            return $script;
        } else {
            return null;
        }
    }
}
