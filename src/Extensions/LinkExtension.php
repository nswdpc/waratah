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
 * @property ?string $Description
 * @property int $ImageID
 * @method \SilverStripe\Assets\Image Image()
 */
class LinkExtension extends DataExtension
{
    private static array $db = [
        'Description' => 'Text'
    ];

    private static array $has_one = [
        "Image" => Image::class,
    ];

    private static array $allowed_file_types = [
        "jpg",
        "jpeg",
        "gif",
        "png",
        "webp"
    ];

    private static array $owns = [
        "Image"
    ];

    /**
     * Get allowed file types
     */
    public function getAllowedFileTypes(): array
    {
        $types = $this->getOwner()->config()->get("allowed_file_types");
        if (empty($types)) {
            $types = ["jpg", "jpeg", "gif", "png", "webp"];
        }
        return array_unique($types);
    }

    /**
     * Update CMS fields for administration of link
     */
    #[\Override]
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
                )->setAllowedExtensions($this->getOwner()->getAllowedFileTypes())
                ->setIsMultiUpload(false)
                ->setDescription(
                    _t(
                        "nswds.ALLOWED_FILE_TYPES",
                        "Allowed file types: {types}",
                        [
                            'types' => implode(",", $this->getOwner()->getAllowedFileTypes())
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
    public function LinkDescription()
    {
        $type = $this->getOwner()->Type;
        $description = $this->getOwner()->Description;
        if (!$description && $type == 'SiteTree') {
            $record = $this->getOwner()->SiteTree();
            if ($record && $record->isInDB() && $record->hasField('Abstract')) {
                $description = trim($record->Abstract ?? '');
            }
        }

        return $description;
    }

    /**
     * Provides a compatibility method for returning the image
     * for a link from the linked SiteTree record, if the link is of type SiteTree
     * @see gorriecoe\Link\Extensions\LinkSiteTree::SiteTree()
     */
    public function LinkImage(): ?Image
    {
        $type = $this->getOwner()->Type;
        $image = $this->getOwner()->Image();
        if ((!$image || !$image->exists()) && $type == 'SiteTree') {
            $record = $this->getOwner()->SiteTree();
            if ($record && $record->isInDB() && $record->hasField('Image')) {
                $image = $record->Image();
            }
        }

        return $image;
    }

}
