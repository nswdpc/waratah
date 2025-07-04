<?php

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\Control\Controller;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Security\Permission;
use SilverStripe\Versioned\Versioned;

/**
 * @extends \SilverStripe\ORM\DataExtension<(\SilverStripe\CMS\Model\SiteTree & static)>
 */
class SiteTreeExtension extends DataExtension
{
    /**
     * Update meta components as required
     */
    public function MetaComponents(array &$tags)
    {

        // conditionally add these components based on CMS preview mode being in place
        unset($tags['pageId']);
        unset($tags['cmsEditLink']);
        $controller = Controller::curr();
        $request = $controller->getRequest();
        if (Permission::check('CMS_ACCESS_CMSMain')
            && $this->getOwner()->ID > 0
            && Versioned::get_stage() === Versioned::DRAFT
            && $request->getVar('CMSPreview') == '1'
        ) {
            $tags['pageId'] = [
                'attributes' => [
                    'name' => 'x-page-id',
                    'content' => $this->getOwner()->ID,
                ],
            ];
            $tags['cmsEditLink'] = [
                'attributes' => [
                    'name' => 'x-cms-edit-link',
                    'content' => $this->getOwner()->CMSEditLink(),
                ],
            ];
        }

        $tags['browserViewport'] = [
            'attributes' => [
                'name' => 'viewport',
                'content' => 'width=device-width, initial-scale=1'
            ]
        ];

    }
}
