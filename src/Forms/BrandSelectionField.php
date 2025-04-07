<?php

namespace NSWDPC\Waratah\Forms;

use NSWDPC\Waratah\Traits\DesignSystemSelections;
use SilverStripe\Forms\DropdownField;

/**
 * Provide a brand selection dropdown to support components that can support a --nsw-brand
 * @author James
 */
class BrandSelectionField extends DropdownField
{
    use DesignSystemSelections;

    /**
     * @inheritdoc
     */
    public function __construct($name, $title = null, $source = [], $value = null)
    {
        $source = $this->getSource();
        $this->setEmptyString(_t('nswds.SELECT', 'Select'));
        parent::__construct($name, $title, $source, $value);
    }

    /**
     *
     * @inheritdoc
     */
    #[\Override]
    public function getSource()
    {
        $this->source = $this->getColourSelectionOptions('brand');
        return parent::getSource();
    }

}
