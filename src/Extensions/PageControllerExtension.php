<?php

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\Core\Extension;

class PageControllerExtension extends Extension
{
    public function ElementNav($position = null)
    {
        $elementArea = $this->owner->ElementalArea();

        if (!$elementArea || !$elementArea->exists()) {
            return false;
        }

        $list = $elementArea->Elements()->filter([
            'ShowInMenus' => 1
        ]);

        if ($list->count()) {
            return $list;
        } else {
            return false;
        }

    }

}
