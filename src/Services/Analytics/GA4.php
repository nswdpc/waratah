<?php

namespace NSWDPC\Waratah\Services\Analytics;

use NSWDPC\AnalyticsChooser\Services\GA3 as ModuleGA4;

/**
 * GA4 implementation
 * @author James
 * @deprecated will be removed at next minor release, use the nswdpc/silverstripe-analytics-chooser GA4 class instead
 */
class GA4 extends ModuleGA4 {

    private static bool $enabled = false;
}
