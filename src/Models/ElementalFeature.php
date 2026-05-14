<?php

namespace NSWDPC\Waratah\Models;

use DNADesign\Elemental\Models\ElementContent;
use SilverStripe\Security\Permission;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\File;
use SilverStripe\Assets\Image;
use gorriecoe\Link\Models\Link;
use gorriecoe\LinkField\LinkField;

/**
 * Feature element that aligns with the NSWDS 'Content Block' component
 * @property int $IconSVGID
 * @property int $IconImageID
 * @method \SilverStripe\Assets\File IconSVG()
 * @method \SilverStripe\Assets\Image IconImage()
 * @method \SilverStripe\ORM\ManyManyList<\gorriecoe\Link\Models\Link> Links()
 */
class ElementalFeature extends ElementContent
{
    private static bool $inline_editable = false;

    private static string $table_name = 'ElementalFeature';

    private static string $singular_name = 'Content block';

    private static string $plural_name = 'Content blocks';

    private static string $description = 'Create a Content block';

    /**
     * @inheritdoc
     */
    private static string $icon = 'font-icon-block-promo-2';

    private static array $has_one = [
        'IconSVG' => File::class,
        'IconImage' => Image::class
    ];

    private static array $many_many = [
        'Links' => Link::class
    ];

    private static array $many_many_extraFields = [
        'Links' => [
            'Sort' => 'Int'
        ]
    ];

    private static array $owns = ['IconSVG','IconImage'];

    /**
     * Provide fields for editing
     */
    #[\Override]
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName(['Links','Subtype','IconSVG','IconImage']);

        if ($htmlField = $fields->dataFieldByName('HTML')) {
            /** @var \SilverStripe\Forms\TextareaField $htmlField */
            $htmlField ->setRows(12);
        }

        $fields->addFieldToTab(
            'Root.Main',
            LinkField::create(
                'Links',
                'Links',
                $this
            ),
            'ParentID'
        );

        $admin = Permission::check('ADMIN');
        if ($admin) {
            $fields->insertAfter(
                'ContentImage',
                $iconSvgField = UploadField::create(
                    'IconSVG',
                    'SVG version of icon'
                )->setAllowedExtensions(['svg'])
                ->setIsMultiUpload(false)
                ->setDescription(
                    _t(
                        static::class . '.ALLOWED_FILE_TYPES_ICON_SVG',
                        'Allowed file types: {types}, Max file size: {maxSize}',
                        [
                            'types' => 'svg',
                            'maxSize' => '32k'
                        ]
                    )
                )
            );
            $iconSvgField->getValidator()->setAllowedMaxFileSize(32768);
        }

        $fields->insertAfter(
            'ContentImage',
            $iconImageField = UploadField::create(
                'IconImage',
                'Image version of icon'
            )->setAllowedExtensions(['png'])
            ->setIsMultiUpload(false)
            ->setDescription(
                _t(
                    static::class . '.ALLOWED_FILE_TYPES_ICON_IMAGE',
                    'Allowed file types: {types}, Max file size: {maxSize}',
                    [
                        'types' => 'png',
                        'maxSize' => '32k'
                    ]
                )
            )
        );
        $iconImageField->getValidator()->setAllowedMaxFileSize(32768);

        return $fields;
    }

    /**
     * @inheritdoc
     */
    #[\Override]
    public function getType()
    {
        return _t(static::class . '.BlockType', 'Content block');
    }

}
