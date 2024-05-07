<?php

namespace NSWDPC\Waratah\Extensions;

use gorriecoe\Link\Models\Link;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextareaField;
use SilverStripe\ORM\DataExtension;

/**
 * Decorate \gorriecoe\Link\Models\Link with extra fields and other
 * requirements
 */
class LinkExtension extends DataExtension
{
    /**
     * @var array
     */
    private static $db = [
        'Description' => 'Text'
    ];

    /**
     * @var array
     */
    private static $has_one = [
        "Image" => Image::class,
    ];

    /**
     * @var array
     */
    private static $allowed_file_types = [
        "jpg",
        "jpeg",
        "gif",
        "png",
        "webp"
    ];

    /**
     * @var array
     */
    private static $owns = [
        "Image"
    ];

    /**
     * Get allowed file types
     */
    public function getAllowedFileTypes() : array
    {
        $types = $this->owner->config()->get("allowed_file_types");
        if (empty($types)) {
            $types = ["jpg", "jpeg", "gif", "png", "webp"];
        }
        $types = array_unique($types);
        return $types;
    }

    /**
     * Update CMS fields for administration of link
     */
    public function updateCMSFields(FieldList $fields)
    {

        $fields->addFieldsToTab(
            'Root.Main',
            [
                TextareaField::create(
                    'Description',
                    _t(
                        'nswds.DESCRIPTION',
                        'Description'
                    )
                )->setRightTitle(
                    _t(
                        'nswds.DESCRIPTION_DESCRIPTION',
                        "Links to 'Pages on this website' will use their Abstract, if set. You can provide a specific description here, just for this link, to override the Page value."
                    )
                )->setTargetLength(100, 50, 150),
                UploadField::create(
                    "Image",
                    _t("nswds.IMAGE", "Image")
                )->setAllowedExtensions($this->owner->getAllowedFileTypes())
                ->setIsMultiUpload(false)
                ->setDescription(
                    _t(
                        "nswds.ALLOWED_FILE_TYPES",
                        "Allowed file types: {types}",
                        [
                            'types' => implode(",", $this->owner->getAllowedFileTypes())
                        ]
                    )
                )->setRightTitle(
                    _t(
                        'nswds.LINK_IMAGE_HELP_TEXT',
                        "Links to 'Pages on this website' will use their Image, if set. You can provide a specific image here, just for this link, to override the Page value."
                    )
                )
            ]
        );

    }

    /**
     * Provides a compatibility method for returning the description
     * for a link from the linked SiteTree record, if the link is of type SiteTree
     * @see gorriecoe\Link\Extensions\LinkSiteTree::SiteTree()
     */
    public function LinkDescription() {
        $type = $this->owner->Type;
        $description = '';
        if($type == 'SiteTree') {
            $record = $this->owner->SiteTree();
            if($record && $record->isInDB() && $record->hasField('Abstract')) {
                $description = trim($record->Abstract ?? '');
            }
        }
        if(!$description) {
            // use this record's Description field, instead
            $description = $this->owner->Description;
        }
        return $description;
    }

    /**
     * Provides a compatibility method for returning the image
     * for a link from the linked SiteTree record, if the link is of type SiteTree
     * @see gorriecoe\Link\Extensions\LinkSiteTree::SiteTree()
     */
    public function LinkImage() : ?Image {
        $type = $this->owner->Type;
        $image = null;
        if($type == 'SiteTree') {
            $record = $this->owner->SiteTree();
            if($record && $record->isInDB() && $record->hasField('Image')) {
                $image = $record->Image();
            }
        }
        if(!$image || !$image->exists()) {
            // use this record's Image field, instead
            $image = $this->owner->Image();
        }
        return $image;
    }

}
