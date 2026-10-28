<?php

declare(strict_types=1);

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\Core\Extension;
use nglasl\mediawesome\MediaPage;

/**
 * @extends \SilverStripe\Core\Extension<(\nglasl\mediawesome\MediaPage & static)>
 */
class MediaPageExtension extends Extension
{
    public function getRecentPosts()
    {
        $mediaHolderID = $this->getOwner()->ParentID;
        $mediaPages = MediaPage::get()->filter('ParentID', $mediaHolderID)->sort('Date', 'DESC');

        if ($mediaPages) {
            return $mediaPages->limit(4);
        }

        return null;
    }

}
