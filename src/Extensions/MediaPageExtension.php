<?php

declare(strict_types=1);

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\Core\Extension;
use SilverStripe\ORM\DataList;
use nglasl\mediawesome\MediaPage;

/**
 * @extends \SilverStripe\Core\Extension<static>
 */
class MediaPageExtension extends Extension
{

    public function getRecentPosts(): ?DataList
    {
        if(\class_exists(MediaPage::class)) {
            /** @var MediaPage $mediaPage */
            $mediaPage = $this->getOwner();
            if($mediaPage && $mediaPage->isInDB() && $mediaPage->ParentID) {
                $mediaHolderID = $mediaPage->ParentID;
                $mediaPages = MediaPage::get()->filter('ParentID', $mediaHolderID)->sort('Date', 'DESC');
                if ($mediaPages) {
                    return $mediaPages->limit(4);
                }
            }
        }

        return null;
    }

}
