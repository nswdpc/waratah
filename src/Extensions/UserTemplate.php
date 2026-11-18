<?php

declare(strict_types=1);

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\Core\Extension;

/**
 * Improve performance of UserTemplate queries
 * On /admin/pages load, a query is repeatedly smashing UserTemplate::get()
 * and UserTemplate::get()->filter('User'....)
 * TODO: PR
 * @author James
 * @extends \SilverStripe\Core\Extension<static>
 */
class UserTemplate extends Extension
{
    private static array $indexes = [
        'Use' => true
    ];
}
