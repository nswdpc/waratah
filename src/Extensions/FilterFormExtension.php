<?php

namespace NSWDPC\Waratah\Extensions;

use NSWDPC\Waratah\Traits\FilterFormTrait;
use SilverStripe\Core\Extension;
use SilverStripe\Forms\Form;

/**
 * Apply this extension to specific forms via configuration, to apply
 * filter form smarts to a form
 * @author James
 * @extends \SilverStripe\Core\Extension<static>
 */
class FilterFormExtension extends Extension
{
    use FilterFormTrait;

    /**
     * Return the owner Form, overrides trait method of same name
     */
    public function getExtendedForm(): Form
    {
        /* @phpstan-ignore return.type */
        return $this->getOwner();
    }

    private static array $default_classes = [
        'nsw-filters',
        'nsw-filters--fixed',
        'js-filters'
    ];

}
