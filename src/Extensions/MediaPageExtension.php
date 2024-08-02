<?php

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\ORM\DataExtension;
use nglasl\mediawesome\MediaPage;

/**
 * @method (\nglasl\mediawesome\MediaPage & static) getOwner()
 */
class MediaPageExtension extends DataExtension {

    public function getRecentPosts()
    {
        $mediaHolderID = $this->getOwner()->ParentID;
        $mediaPages = MediaPage::get()->filter('ParentID', $mediaHolderID)->sort('Date', 'DESC');

        if ($mediaPages)
        {
          return $mediaPages->limit(4);
        }

        return null;
    }

}
