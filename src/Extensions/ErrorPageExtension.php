<?php

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\CMS\Model\SiteTreeExtension;

/**
 * Make all ErrorPages visible regardless of site settings
 *
 */
class ErrorPageExtension extends SiteTreeExtension
{
    public function canView()
    {
        return true;
    }

    public function includeElemental()
    {
        return false;
    }
}
