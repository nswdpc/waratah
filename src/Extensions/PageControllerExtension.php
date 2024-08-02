<?php

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\Core\Extension;

/**
 * @method (\PageController & static) getOwner()
 */
class PageControllerExtension extends Extension
{

    public function ElementNav($position = null)
    {
        $elementArea = $this->getOwner()->ElementalArea();

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
