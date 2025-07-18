<?php

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\ORM\DataExtension;

/**
 * @property ?string $PhotoCredit
 * @extends \SilverStripe\ORM\DataExtension<(\SilverStripe\Assets\Image & static)>
 */
class ImageExtension extends DataExtension
{
    private static array $db = [
        'PhotoCredit' => 'Varchar(255)'
    ];
}
