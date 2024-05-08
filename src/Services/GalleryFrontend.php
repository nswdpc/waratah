<?php

namespace NSWDPC\Waratah\Services;

use NSWDPC\Elemental\Services\QuickGallery\Frontend;

use SilverStripe\View\Requirements;

/**
 * Provides a basic frontend using Slick
 * Apply your own frontend and/or frontend loader using Injector
 * @author James
 */
class GalleryFrontend extends Frontend {

    /**
     * Apply loader to the relevant slideshow classes
     * In the context of nswds, the gallery frontend is applied to any
     * element with a data-gallery attribute, it must contain figure elements
     * from nswds/Media
     */
    public function addLoader() {

        $anchor = $this->element->getAnchor();

        $script = <<<JS
$(document).ready(function(){
    $('#{$anchor} [data-gallery]').slickLightbox({
        itemSelector: 'figure a:first-child',
        caption: function(element, info) {
            let cElem = $(element).parent().next('figcaption');
            return cElem.length > 0 ? $(cElem).html() : '';
        },
        captionPosition: 'dynamic',
        lazy: true
    });
});
JS;
        Requirements::customScript($script, "gallery-{$anchor}");

    }
}
