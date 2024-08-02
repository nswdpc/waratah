<?php

namespace NSWDPC\Waratah\Services\Analytics;

use NSWDPC\AnalyticsChooser\Services\GA3 as ModuleGA3;

/**
 * GA3 implementation
 * @author James
 * @deprecated will be removed at next minor release, use the nswdpc/silverstripe-analytics-chooser GA3 class instead
 */
class GA3 extends ModuleGA3 {

    private static bool $enabled = false;

}
