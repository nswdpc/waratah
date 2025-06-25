<?php

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Assets\Image;

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
