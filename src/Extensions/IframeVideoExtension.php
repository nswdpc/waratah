<?php

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\Core\Extension;
use NSWDPC\Elemental\Models\FeaturedVideo\GalleryVideo;
use NSWDPC\Elemental\Models\FeaturedVideo\ElementFeaturedVideo;
use SilverStripe\View\Requirements;

/**
 * Provides lazy-loading support for videos added
 * via the nswdpc/silverstripe-elemental-feature-video module
 * @todo improve the module to use a lazy-loading trait provided by the elemental-iframe module
 */
class IframeVideoExtension extends Extension
{
    /**
     * Provide a method to handle lazy loading flag, this is on for everything, for now
     */
    public function WillLazyLoad(): bool
    {
        return true;
    }

    /**
     * Provide a polyfill method, accessible from a template
     */
    public function Polyfill(): string
    {
        if ($this->getOwner()->WillLazyLoad()) {
            Requirements::javascript(
                "https://cdnjs.cloudflare.com/ajax/libs/loading-attribute-polyfill/1.5.4/loading-attribute-polyfill.min.js",
                [
                    "integrity" => "sha512-Kq3/MTxphzXJIRDWtrpLhhNnLDPiBXPMKkx/KogMYZO92Geor9j8sJguZ1OozBS+YVmVKo2HEx2gZfGOQBFM8A==",
                    "crossorigin" => "anonymous"
                ]
            );
        }

        return '';
    }
}
