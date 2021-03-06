<?php

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\ORM\DataExtension;

/**
 * Improve performance of UserTemplate queries
 * On /admin/pages load, a query is repeatedly smashing UserTemplate::get()
 * and UserTemplate::get()->filter('User'....)
 * TODO: PR
 * @author James
 */
class UserTemplate extends DataExtension {
    /**
     * @var array
     */
    private static $indexes = [
        'Use' => true
    ];
}
