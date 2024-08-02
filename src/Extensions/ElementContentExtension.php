<?php

namespace NSWDPC\Waratah\Extensions;

use DNADesign\Elemental\Models\ElementContent;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\FieldList;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use gorriecoe\Link\Models\Link;
use NSWDPC\InlineLinker\InlineLinkCompositeField;
use NSWDPC\Elemental\Models\DecoratedContent\ElementDecoratedContent;
use NSWDPC\Elemental\Models\FeaturedVideo\ElementFeaturedVideo;

/**
 * Provides a "Content Image" and "Content Link" field for ElementContent
 *
 *
 * For BC:
 * Quick migration of ImageID->ContentImageID
 * This avoids collisions with historical usage of ElementDecoratedContent.Image
 * mysql> UPDATE ElementContent SET ContentImageID = ImageID WHERE ImageID <> 0;
 * mysql> ALTER TABLE ElementContent DROP COLUMN ImageID;
 *
 * @author Mark Taylor
 * @author James Ellis
 * @property int $ContentImageID
 * @property int $ContentLinkID
 * @method \SilverStripe\Assets\Image ContentImage()
 * @method \gorriecoe\Link\Models\Link ContentLink()
 * @method (\DNADesign\Elemental\Models\ElementContent & static) getOwner()
 */
class ElementContentExtension extends DataExtension
{

    private static array $has_one = [
        'ContentImage' => Image::class,//avoid collision with ElementDecoratedContent
        'ContentLink' => Link::class,
    ];

    private static array $allowed_file_types = ['jpg', 'jpeg', 'gif', 'png', 'webp'];

    private static array $owns = ['ContentImage', 'ContentLink'];

    /**
     * @var array
     */
    public function getAllowedFileTypes(): array
    {
        $types = $this->getOwner()->config()->get('allowed_file_types');
        if (empty($types) || !is_array($types)) {
            $types = ['jpg', 'jpeg', 'gif', 'png', 'webp'];
        }
        return array_unique($types);
    }

    /**
     * These fields can only be applied to ElementContent directly, not subclasses
     * If the current owner is ignored, remove the fields and return true
     */
    public function handleIgnoredOwner(FieldList $fields) : bool {
        $classes = [
            ElementDecoratedContent::class,
            ElementFeaturedVideo::class
        ];
        $ignored_subclasses = $this->getOwner()->config()->get('ignored_subclasses');
        if(is_array($ignored_subclasses)) {
            $classes = array_merge($classes, $ignored_subclasses);
        }

        if( in_array($this->getOwner()::class, $classes) ) {
            $fields->removeByName(['ContentLinkID','ContentLink','ContentImageID','ContentImage']);
            return true;
        }

        return false;
    }

    /**
     * Apply image and link fields to the Settings tab
     */
    public function updateCMSFields(FieldList $fields): void
    {

        if($this->getOwner()->handleIgnoredOwner($fields)) {
            return;
        }

        $fields->removeByName(['ContentLinkID']);
        $fields->addFieldToTab(
            'Root.Image',
                UploadField::create(
                    'ContentImage',
                    _t('nswds.IMAGE', 'Image')
                )
                ->setAllowedExtensions($this->getOwner()->getAllowedFileTypes())
                ->setIsMultiUpload(false)
                ->setDescription(
                    _t(
                        'nswds.ALLOWED_FILE_TYPES',
                        'Allowed file types: {types}',
                        [
                            'types' => implode(",", $this->getOwner()->getAllowedFileTypes())
                        ]
                    )
                )
        );
        $fields->addFieldToTab(
            'Root.Link',
                $this->getLinkField()
        );
    }

    /**
     * Return the inline link field to handle link selection
     */
    protected function getLinkField() : InlineLinkCompositeField {
        return InlineLinkCompositeField::create(
            'ContentLink',
            _t(
                'nswds.LINK',
                'Link'
            ),
            $this->getOwner()
        );
    }

}
