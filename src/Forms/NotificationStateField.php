<?php

namespace NSWDPC\Waratah\Forms;

use NSWDPC\Waratah\Traits\DesignSystemSelections;
use SilverStripe\Forms\DropdownField;

/**
 * Provide a notification state selection dropdown
 * @author James
 */
class NotificationStateSelectionField extends DropdownField
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
    public function getSource()
    {
        $this->source = $this->getColourSelectionOptions('notificationstate');
        return parent::getSource();
    }

    /**
     * Returns the icon related to the notification state
     * The return value is a Material Icon code
     */
    public static function getIconCode($state) : string {
        switch($state) {
            case 'warning':
                return 'error';
                break;
            case 'error':
                // critical
                return 'cancel';
                break;
            case 'success':
                return 'check_circle';
                break;
            case 'info':
            default:
                return 'info';
                break;
        }
    }

}
