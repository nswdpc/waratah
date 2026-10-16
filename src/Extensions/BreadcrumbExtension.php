<?php

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\Core\Extension;

/**
 * Provide an extension to allow pages to override aspects of Breacrumb-ing
 * @author James
 * @extends \SilverStripe\Core\Extension<(\Page & static)>
 */
class BreadcrumbExtension extends Extension
{
    public function BreadcrumbLink()
    {
        return $this->getOwner()->Link();
    }
}
