<?php

namespace NSWDPC\Waratah\Services\Analytics;

use NSWDPC\AnalyticsChooser\Services\GTM as ModuleGTM;

/**
 * GTM implementation
 * @author James
 * @deprecated will be removed at next minor release, use the nswdpc/silverstripe-analytics-chooser GTM class instead
 */
class GTM extends ModuleGTM {

    private static bool $enabled = false;
}
