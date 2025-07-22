<?php

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\ORM\DataExtension;

/**
 * Provide an extension to allow pages to override aspects of Breacrumb-ing
 * @author James
 * @extends \SilverStripe\ORM\DataExtension<(\Page & static)>
 */
class BreadcrumbExtension extends DataExtension
{
    public function BreadcrumbLink()
    {
        return $this->getOwner()->Link();
    }
}
