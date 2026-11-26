<?php

declare(strict_types=1);

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\Core\Extension;

/**
 * @property ?string $PhotoCredit
 * @extends \SilverStripe\Core\Extension<(\SilverStripe\Assets\Image & static)>
 */
class ImageExtension extends Extension
{
    private static array $db = [
        'PhotoCredit' => 'Varchar(255)'
    ];
}
