<?php

namespace NSWDPC\Waratah\Forms;

use SilverStripe\Forms\ListboxField;

/**
 * A listbox field but with addable option added
 * Note: to handle save the submitted values, use a save<Fieldname> method in the relevant DataObject
 * @author James
 */
class AddableListboxField extends ListboxField
{
    public const PREFIX = 'new=';

    /**
     * Constructor, add addable data attribute
     */
    public function __construct($name, $title = '', $source = [], $value = null, $size = null)
    {
        parent::__construct($name, $title, $source, $value, $size);
        $this->setAttribute('data-addable', '1');
    }

    /**
     * Determine if a value is prefixed with the relevant prefix
     */
    public static function isAddableValue(mixed $value): bool
    {
        return is_string($value) && str_starts_with($value, self::PREFIX);
    }

    /**
     * Return the addable value, if it is one, sans the prefix
     */
    public static function getAddableValue(string $value): string
    {
        if (self::isAddableValue($value)) {
            $output = substr($value, strlen(self::PREFIX));
        } else {
            $output = $value;
        }

        return trim(strip_tags($output));
    }

    /*
     * Override isSelectedValue to allow self::PREFIX prefixed values as a valid value
     */
    public function isSelectedValue($dataValue, $userValue)
    {
        $isSelected = parent::isSelectedValue($dataValue, $userValue);
        if ($this->getAttribute('data-addable') === '1' && self::isAddableValue($userValue)) {
            return true;
        }

        return $isSelected;
    }

}
