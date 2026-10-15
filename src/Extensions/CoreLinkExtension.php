<?php

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\LinkField\Models\Link;
use SilverStripe\LinkField\Models\SiteTreeLink;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Core\Extension;

/**
 * Decorate \SilverStripe\LinkField\Models\Link with extra fields and other
 * requirements
 * @property ?string $CoreLinkDescription
 * @property int $CoreLinkImageID
 * @method \SilverStripe\Assets\Image Image()
 * @extends \SilverStripe\Core\Extension<(\SilverStripe\LinkField\Models\Link & static)>
 */
class CoreLinkExtension extends Extension
{
    private static array $db = [
        // use a specific field name to avoid generic field clashes
        'CoreLinkDescription' => 'Text'
    ];

    private static array $has_one = [
        // use a specific field name to avoid generic field clashes
        "CoreLinkImage" => Image::class,
    ];

    private static array $allowed_file_types = [
        "jpg",
        "jpeg",
        "gif",
        "png",
        "webp"
    ];

    private static array $owns = [
        "CoreLinkImage"
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
    public function updateCMSFields(FieldList $fields)
    {

        $descriptionField = TextareaField::create(
            'CoreLinkDescription',
            _t(
                'nswds.DESCRIPTION',
                'Description'
            )
        )->setRightTitle(
            _t(
                'nswds.DESCRIPTION_DESCRIPTION',
                "Links to 'Pages on this website' will use their Abstract, if set. You can provide a specific description here, just for this link, to override the Page value."
            )
        );
        $descriptionField->setTargetLength(100, 50, 150);

        $fields->push(
            $descriptionField
        );

        $fields->push(
            UploadField::create(
                "CoreLinkImage",
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
        );

    }

    /**
     * Template method for getLinkDescription()
     */
    public function LinkDescription()
    {
        return $this->getLinkDescription();
    }

    /**
     * Provides a compatibility method for returning the description
     * for a link from the linked SiteTree record, if the link is of type SiteTreeLink
     */
    public function getLinkDescription()
    {
        $owner = $this->getOwner();
        $description = $owner->CoreLinkDescription;
        if (!$description && ($owner instanceof SiteTreeLink)) {
            $record = $owner->Page();
            if ($record && $record->isInDB() && $record->hasField('Abstract')) {
                $description = trim($record->Abstract ?? '');
            }
        }

        return $description;
    }

    /**
     * Template method for getLinkImage()
     */
    public function LinkImage()
    {
        return $this->getLinkImage();
    }

    /**
     * Provides a compatibility method for returning the image
     * for a link from the linked SiteTree record, if the link is of type SiteTree
     */
    public function getLinkImage(): ?Image
    {
        $owner = $this->getOwner();
        $image = $owner->CoreLinkImage();
        if ((!$image || !$image->exists()) && ($owner instanceof SiteTreeLink)) {
            $record = $owner->Page();
            if ($record && $record->isInDB() && $record->hasField('Image')) {
                /* @phpstan-ignore method.notFound */
                $image = $record->Image();
            }
        }

        return $image;
    }

}
