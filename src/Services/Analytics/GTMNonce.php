<?php

namespace NSWDPC\Waratah\Services\Analytics;

use SilverStripe\Core\Config\Configurable;
use SilverStripe\ORM\FieldType\DBHTMLText;
use SilverStripe\View\Requirements;

/**
 * GTM nonce-aware implementation
 * Ref: https://developers.google.com/tag-platform/tag-manager/web/csp
 * @author James
 */
class GTMNonce extends GTM {

    /**
     * @inheritdoc
     */
    public static function getCode() : string {
        return "GTMNonce";
    }

    /**
     * @inheritdoc
     */
    public static function getDescription() : string {
        return _t('nswds.GOOGLE_TAG_MANAGER_NONCE_AWARE', 'Google Tag Manager with a Content Security Policy enabled - (gtm.js)');
    }

    /**
     * Add requirements or similar to the current request
     */
    public function provide(string $code = '') : ?DBHTMLText {
        $code = json_encode(htmlspecialchars($code));
        $script =
<<<JAVASCRIPT
(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;var n=d.querySelector('[nonce]');
n&&j.setAttribute('nonce',n.nonce||n.getAttribute('nonce'));f.parentNode.insertBefore(j,f);
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
