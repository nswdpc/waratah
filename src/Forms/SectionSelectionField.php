<?php

namespace NSWDPC\Waratah\Forms;

use NSWDPC\Waratah\Traits\DesignSystemSelections;
use SilverStripe\Forms\DropdownField;

/**
 * Provide selection options for section backgrounds
 * @author James
 */
class SectionSelectionField extends DropdownField
{

    use DesignSystemSelections;

    /**
     * @inheritdoc
     */
    public function __construct($name, $title = null, $source = [], $value = null)
    {
        $source = $this->getSource();
        $this->setEmptyString(_t('nswds.SELECT_OPTION', 'Select an option'));
        parent::__construct($name, $title, $source, $value);
    }

    /**
     *
     * @inheritdoc
     */
    public function getSource()
    {
        $options = $this->getColourSelectionOptions('section');
        $source = [];
        foreach($options as $k => $v) {
            $source[ $k ] = _t('nswds.BACKGROUND_' . strtoupper($k), $v);
        }

        $this->source = $source;
        return parent::getSource();
    }

}
