<?php
namespace NSWDPC\Waratah\Extensions;

use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Assets\Image;

class ImageExtension extends DataExtension {

    private static $db = array(
        'PhotoCredit' => 'Varchar(255)'
    );
}
