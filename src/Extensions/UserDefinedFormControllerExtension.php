<?php

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\Core\Extension;

/**
 * Extension handling for UserDefinedFormController
 * @author James
 * @extends \SilverStripe\Core\Extension<(\SilverStripe\UserForms\Control\UserDefinedFormController & static)>
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
