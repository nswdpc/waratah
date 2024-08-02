<?php

namespace NSWDPC\Waratah\Services\Analytics;

use NSWDPC\AnalyticsChooser\Services\AbstractAnalyticsService as ModuleAbstractAnalyticsService;

/**
 * Provides an abstract implementation for analytics services
 * @author James
 * @deprecated will be removed at next minor release, use the nswdpc/silverstripe-analytics-chooser instead
 */
abstract class AbstractAnalyticsService extends ModuleAbstractAnalyticsService {

    private static bool $enabled = false;

}
