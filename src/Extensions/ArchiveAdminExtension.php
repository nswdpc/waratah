<?php

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\Core\Extension;

/**
 * Ensure the selector field is added to the Archive admin form
 * Fixes a bug with the field not being added in some contexts
 * Ref: https://github.com/silverstripe/silverstripe-versioned-admin/issues/198
 * @author James
 */
class ArchiveAdminExtension extends Extension
{

    public function updateEditForm($form) {
        $modelSelectField = $this->owner->getOtherModelSelectorField($this->owner->modelClass);
        if($form && $modelSelectField) {
            $form->Fields()->unshift($modelSelectField);
        }
    }

}
