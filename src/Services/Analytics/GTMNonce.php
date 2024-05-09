<?php

namespace NSWDPC\Waratah\Services\Analytics;

use NSWDPC\AnalyticsChooser\Services\GTMNonce as ModuleGTMNonce;

/**
 * GTM nonce-aware implementation
 * @author James
 * @deprecated will be removed at next minor release, use the nswdpc/silverstripe-analytics-chooser GTMNonce class instead
 */
class GTMNonce extends ModuleGTMNonce {

    /**
     * @var bool
     */
    private static $enabled = false;
}
