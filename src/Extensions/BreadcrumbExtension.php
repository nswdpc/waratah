<?php

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\Core\Injector\Injector;
use SilverStripe\Core\Config\Config;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\CheckboxField;

/**
 * Provide an extension to allow pages to override aspects of Breacrumb-ing
 * @author James
 */
class BreadcrumbExtension extends DataExtension
{
    public function BreadcrumbLink()
    {
        return $this->getOwner()->Link();
    }
}
