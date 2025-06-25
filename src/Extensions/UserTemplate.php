<?php

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\ORM\DataExtension;

/**
 * Improve performance of UserTemplate queries
 * On /admin/pages load, a query is repeatedly smashing UserTemplate::get()
 * and UserTemplate::get()->filter('User'....)
 * TODO: PR
 * @author James
 * @extends \SilverStripe\ORM\DataExtension<(static & \Symbiote\UserTemplates\UserTemplate)>
 */
class UserTemplate extends DataExtension
{
    private static array $indexes = [
        'Use' => true
    ];
}
