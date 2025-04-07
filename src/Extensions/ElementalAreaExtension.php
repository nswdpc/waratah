<?php

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\ORM\DataExtension;

/**
 * Provide additional configuration options for Elemental Areas
 * to define context and avoid all the fun of using a subclass of ElementalArea
 * @author James
 */
class ElementalAreaExtension extends DataExtension
{

    /**
     * @var array
     */
    private static $db = [
        'IsSideArea' => 'Boolean',
        'IsTopArea' => 'Boolean',
        'AllowContainer' => 'Boolean',
        'AllowSectionModification' => 'Boolean',
        'RenderElementDirectly' => 'Boolean',
    ];

    /**
     * @var array
     */
    private static $defaults = [
        'IsSideArea' => 0,
        'IsTopArea' => 0,
        'AllowContainer' => 0,
        'AllowSectionModification' => 0,
        'RenderElementDirectly' => 0
    ];

    /**
     * Return a context title for assistance with sorting out which area is which
     */
    public function ContextTitle() {
        if($this->owner->IsSideArea == 1) {
            return _t('nswds.SIDE_CONTENT', 'Side content');
        } else if($this->owner->IsTopArea == 1) {
            return _t('nswds.TOP_CONTENT', 'Top content');
        } else {
            return _t('nswds.MAIN_CONTENT', 'Main content');
        }
    }

}
