<?php

namespace NSWDPC\Waratah\Forms;

use NSWDPC\Waratah\Traits\DesignSystemSelections;
use SilverStripe\Forms\DropdownField;

/**
 * Footer brand selection
 * @author James
 */
class FooterBrandSelectionField extends DropdownField
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
        $this->source = $this->getColourSelectionOptions('footerbrand');
        return parent::getSource();
    }
}
