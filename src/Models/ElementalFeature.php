<?php

namespace NSWDPC\Waratah\Models;

use DNADesign\Elemental\Models\ElementContent;
use SilverStripe\Security\Permission;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\File;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\LiteralField;
use gorriecoe\Link\Models\Link;
use gorriecoe\LinkField\LinkField;

/**
 * Feature element that aligns with the NSWDS 'Content Block' component
 */
class ElementalFeature extends ElementContent
{

    /**
     * @var bool
     */
    private static $inline_editable = false;

    /**
     * @var string
     */
    private static $table_name = 'ElementalFeature';

    /**
     * @var string
     */
    private static $singular_name = 'Content block';

    /**
     * @var string
     */
    private static $plural_name = 'Content blocks';

    /**
     * @var string
     */
    private static $description = 'Create a Content block';

    /**
     * @inheritdoc
     */
    private static $icon = 'font-icon-block-promo-2';

    /**
     * @var array
     */
    private static $has_one = [
        'IconSVG' => File::class,
        'IconImage' => Image::class
    ];

    /**
     * @var array
     */
    private static $many_many = [
        'Links' => Link::class
    ];

    /**
     * @var array
     */
    private static $many_many_extraFields = [
        'Links' => [
            'Sort' => 'Int'
        ]
    ];

    /**
     * @var array
     */
    private static $owns = ['IconSVG','IconImage'];

    /**
     * Provide fields for editing
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName(['Links','Subtype','IconSVG','IconImage']);

        if($htmlField = $fields->dataFieldByName('HTML')) {
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
        if($admin) {
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
    public function getType()
    {
        return _t(static::class . '.BlockType', 'Content block');
    }

}
