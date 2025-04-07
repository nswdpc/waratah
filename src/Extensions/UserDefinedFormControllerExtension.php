<?php

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\Core\Extension;

/**
 * Extension handling for UserDefinedFormController
 * @author James
 */
class UserDefinedFormControllerExtension extends Extension
{
    /**
     * Handle before init call
     */
    public function onBeforeInit()
    {
        // Require the supported version of jQuery, only
        DesignSystemAssetExtension::requireJquery();
    }
}
