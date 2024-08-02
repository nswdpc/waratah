<?php
namespace NSWDPC\Waratah\Extensions;

use Silverstripe\ORM\DataExtension;
use Silverstripe\Forms\FieldList;
use Silverstripe\Forms\TextField;
use Silverstripe\Assets\Image;

/**
 * @property string $PhotoCredit
 * @method (\SilverStripe\Assets\Image & static) getOwner()
 */
class ImageExtension extends DataExtension {

    private static array $db = ['PhotoCredit' => 'Varchar(255)'];
}
