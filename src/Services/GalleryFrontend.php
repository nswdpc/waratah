<?php

namespace NSWDPC\Waratah\Services;

use NSWDPC\Elemental\Models\QuickGallery\ElementQuickGallery;
use NSWDPC\Elemental\Services\QuickGallery\Frontend;
use NSWDPC\Waratah\Extensions\DesignSystemAssetExtension;
use SilverStripe\View\Requirements;

/**
 * Provides a basic frontend using Slick
 * Apply your own frontend and/or frontend loader using Injector
 * QuickGallery does not provide jquery
 * @author James
 */
class GalleryFrontend extends Frontend
{

    /**
     * @inheritdoc
     * Add jQuery requirement prior to adding module's gallery requirements
     */
    #[\Override]
    public function addRequirements(ElementQuickGallery $element) {
        DesignSystemAssetExtension::requireJquery();
        parent::addRequirements($element);
    }

    /**
     * Apply loader to the relevant slideshow classes
     * In the context of nswds, the gallery frontend is applied to any
     * element with a data-gallery attribute, it must contain figure elements
     * from nswds/Media
     */
    #[\Override]
    public function addLoader()
    {

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
