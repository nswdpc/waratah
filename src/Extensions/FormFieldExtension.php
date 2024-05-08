<?php

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Forms\FormField;
use SilverStripe\Forms\ListboxField;

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
     * Whether to use the nsw-design-system multi select component
     * This only applies to ListboxField fields. To enable this component,
     * set an attribute 'data-nsw-multiselect'on the field
     *
     * The default is to not use the component.
     */
    public function UseMultiSelectComponent() : bool {
        return ($this->owner instanceof ListboxField)
            && $this->owner->getAttribute('data-nsw-multiselect');
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

    /**
     * Set a grid option via a data attribute, with one of the supported grid options
     */
    public function setGridOption(string $gridOption) {
        if(!($this->owner instanceof CompositeField)) {
            throw new \RuntimeException("Only composite fields can have a grid option set");
        }
        return $this->owner->setAttribute('data-grid-option', $gridOption);
    }

    /**
     * Template variable for returning a grid option. See CompositeField_holder
     */
    public function GridOption() : ?string {
        return $this->owner->getAttribute('data-grid-option');
    }

}
