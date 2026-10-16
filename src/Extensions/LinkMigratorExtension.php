<?php

namespace NSWDPC\Waratah\Extensions;

use gorriecoe\Link\Models\Link as OldLink;
use SilverStripe\Core\Extension;
use SilverStripe\LinkField\Models\Link as CoreLink;

/**
 * Handles field migration of the 'Image' and 'Description' fields applied in \NSWDPC\Waratah\Extensions\LinkExtension
 * to the target fields in NSWDPC\Waratah\Extensions\CoreLinkExtension
 * @extends \SilverStripe\Core\Extension<(\gorriecoe\LinkField\Migration\LinkMigrator & static)>
 */
class LinkMigratorExtension extends Extension
{
    public function updateMigratedLink(CoreLink $newLink, OldLink $oldLink): void
    {
        $newLink->CoreLinkImageID = $oldLink->ImageID;
        $newLink->CoreLinkDescription = $oldLink->Description;
    }
}
