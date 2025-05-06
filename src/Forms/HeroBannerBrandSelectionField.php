<?php

namespace NSWDPC\Waratah\Forms;

use NSWDPC\Waratah\Traits\DesignSystemSelections;
use SilverStripe\Forms\DropdownField;

/**
 * HeroBanner brand selection
 * @author James
 */
class HeroBannerBrandSelectionField extends DropdownField
{
    use DesignSystemSelections;

    /**
     *
     * @inheritdoc
     */
    #[\Override]
    public function getSource()
    {
        $this->source = $this->getColourSelectionOptions('herobannerbrand');
        return parent::getSource();
    }
}
