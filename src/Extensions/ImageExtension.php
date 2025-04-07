<?php

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Assets\Image;

/**
 * @property ?string $PhotoCredit
 */
class ImageExtension extends DataExtension
{
    private static array $db = [
        'PhotoCredit' => 'Varchar(255)'
    ];
}
