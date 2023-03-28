<?php

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\FormField;

class FormFieldExtension extends Extension
{

    /**
     * Remove `default_classes` from the ExtraClass and return that
     * to avoid default nsw-* classes being added to the field holder
     * @return string
     */
    public function ParentExtraClass() : string {
        $extraClasses = $this->owner->extraClasses;
        if(empty($extraClasses) || !is_array($extraClasses)) {
            return "";
        }
        $defaultClasses = $this->owner->config()->get('default_classes');
        if(empty($defaultClasses) || !is_array($defaultClasses)) {
            return "";
        }
        // values in extraClasses not present in defaultClasses
        $diff = array_diff($extraClasses, $defaultClasses);
        $classes = trim(implode(' ', $diff));
        return $classes;
    }

    /**
     * Helper method to return whether the field is in a filter form
     */
    public function InFilterForm() : bool {
        $form = $this->owner->getForm();
        if($form && $form->hasMethod('IsFilterForm')) {
            return $form->IsFilterForm() ? true: false;
        } else {
            return false;
        }
    }

    /**
     * Return the FieldHolder template for inclusion within a FilterForm
     * in the context of the field being collapsed
     */
    public function FiltersCollapsedFieldHolder() {
        $properties = [
            'Title' => ''
        ];
        return $this->owner->FieldHolder( $properties );
    }

}
