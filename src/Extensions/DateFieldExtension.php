<?php

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\FormField;
use SilverStripe\Forms\ListboxField;

/**
 * Extension applies the NSW Design System date input template.
 *
 * Browser default
 * =====================
 * The native browser date picker is preferred. To enable this in your project,
 * add the following YAML config to your app/_config/extensions.yml:
 *
 * Silverstripe\Forms\DateField:
 *   extensions:
 *     - NSWDPC\Waratah\Extensions\DateFieldExtension
 *
 * Attributes
 * =====================
 * Max/min and non-selectable dates can be added via the standard setAttribute() method:
 *
 * $field->setAttribute('data-min-date','31/12/2020')
 * $field->setAttribute('data-min-date','31/12/2022')
 * $field->setAttribute('data-dates-disabled','20/01/2022 01/04/2021')
 *
 * This extension does not (yet) implement the picker on the DateCompositeField from the
 * nswdpc/silverstripe-datetime-inputs module
 */
class DateFieldExtension extends Extension
{

    /**
     * Update the available attributes for the input
     */
    public function updateAttributes(&$attributes) {
        $attributes['autocomplete'] = 'off';
        $attributes['type'] = 'text';// component blocks native browser type
        if(!isset($attributes['class'])) {
            $attributes['class'] = '';
        }
        $attributes['class'] .= ' nsw-form__input js-date-input__text';
        $attributes['class'] = trim($attributes['class']);
    }

    /**
     * Update render templates
     */
    public function onBeforeRenderHolder($context, $properties) {
        $this->owner->setInputType('text');
        $this->owner->setTemplate('NSWDPC/Waratah/Forms/DateField');
        $this->owner->setFieldHolderTemplate('NSWDPC/Waratah/Forms/DateField_holder');
    }

}
