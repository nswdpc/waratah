<?php

declare(strict_types=1);

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\Core\Extension;

/**
 * Make all ErrorPages visible regardless of site settings
 *
 * @extends \SilverStripe\Core\Extension<(\SilverStripe\ErrorPage\ErrorPage & static)>
 */
class ErrorPageExtension extends Extension
{
    public function canView(): bool
    {
        return true;
    }

    public function includeElemental(): bool
    {
        return false;
    }
}
