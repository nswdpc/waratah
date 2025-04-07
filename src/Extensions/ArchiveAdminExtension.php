<?php

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\Core\Extension;

/**
 * Ensure the selector field is added to the Archive admin form
 * Fixes a bug with the field not being added in some contexts
 * Ref: https://github.com/silverstripe/silverstripe-versioned-admin/issues/198
 * @author James
 * @extends \SilverStripe\Core\Extension<(\SilverStripe\VersionedAdmin\ArchiveAdmin & static)>
 */
class ArchiveAdminExtension extends Extension
{
    public function updateEditForm($form)
    {
        $modelSelectField = $this->getOwner()->getOtherModelSelectorField($this->getOwner()->modelClass);
        if ($form && $modelSelectField) {
            $form->Fields()->unshift($modelSelectField);
        }
    }

}
