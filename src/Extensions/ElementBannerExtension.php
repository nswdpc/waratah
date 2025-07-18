<?php

namespace NSWDPC\Waratah\Extensions;

use NSWDPC\Waratah\Forms\HeroBannerBrandSelectionField;
use SilverStripe\ORM\DataExtension;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use gorriecoe\Link\Models\Link;
use gorriecoe\LinkField\LinkField;
use NSWDPC\InlineLinker\InlineLinkCompositeField;
use UncleCheese\DisplayLogic\Forms\Wrapper;

/**
 * Design system integration for Banner element
 * @property ?string $BannerStyle
 * @property bool $AltStyle
 * @property ?string $BannerBrand
 * @property ?string $HTML
 * @property ?string $BannerLinksTitle
 * @method \SilverStripe\ORM\ManyManyList<\gorriecoe\Link\Models\Link> BannerLinks()
 * @extends \SilverStripe\ORM\DataExtension<(\NSWDPC\Elemental\Models\Banner\ElementBanner & static)>
 */
class ElementBannerExtension extends DataExtension
{
    /**
     * Branding constants
     */
    public const BRAND_NONE = '';

    public const BRAND_DARK = 'dark';

    public const BRAND_LIGHT = 'light';

    private static bool $inline_editable = false;

    private static array $db = [
        'BannerStyle' => 'Varchar(64)',
        'AltStyle' => 'Boolean',// deprecated - see BannerBrand
        'BannerBrand' => 'Varchar(16)',// @since nswds v2.14
        'HTML' => 'HTMLText',
        'BannerLinksTitle' => 'Varchar(128)',
    ];

    private static array $many_many = [
        'BannerLinks' => Link::class
    ];

    private static array $many_many_extraFields = [
        'BannerLinks' => [
            'Sort' => 'Int'
        ]
    ];

    private static array $banner_styles = [
        'title-content' => 'Title and content',
        'title-content-image' => 'Title and content - with image',
        'call-to-action' => 'Call to action',
        'call-to-action-image' => 'Call to action - with image',
        'links-list' => 'Links list'
    ];

    #[\Override]
    public function updateCMSFields(FieldList $fields)
    {

        $fields->removeByName(['BannerLinks','BannerLink', 'AltStyle']);

        $bannerStyleField = DropdownField::create(
            'BannerStyle',
            _t('nswds.BANNERSTYLE', 'Layout'),
            $this->getOwner()->config()->get("banner_styles")
        );

        $bannerBrandingField = HeroBannerBrandSelectionField::create(
            'BannerBrand',
            _t('nswds.BANNERBRAND', 'Brand')
        );

        $imageField = UploadField::create(
            "Image",
            _t("nswds.SLIDE_IMAGE", "Image")
        );
        $imageField->setAllowedExtensions($this->getOwner()->getAllowedFileTypes());
        $imageField->setIsMultiUpload(false);
        $imageField->setDescription(
            _t(
                "nswds.ALLOWED_FILE_TYPES",
                "Allowed file types: {types}",
                [
                    'types' => implode(",", $this->getOwner()->getAllowedFileTypes())
                ]
            )
        );
        $imageField
            ->displayIf('BannerStyle')
            ->isEqualTo('title-content-image')
            ->orIf()->isEqualTo('call-to-action-image');

        $linkField = Wrapper::create(InlineLinkCompositeField::create(
            'BannerLink',
            _t(
                'nswds.LINK',
                'Link'
            ),
            $this->getOwner()
        ));
        $linkField
            ->displayIf('BannerStyle')
            ->isEqualTo('call-to-action')
            ->orIf()->isEqualTo('call-to-action-image');

        $linksFieldTitle = TextField::create(
            'BannerLinksTitle',
            _t('nswds.LINKSTITLE', 'Links title'),
        );
        $linksFieldTitle
            ->displayIf('BannerStyle')
            ->isEqualTo('links-list');

        $linksField = LinkField::create(
            'BannerLinks',
            _t('nswds.LINKS', 'Links'),
            $this->getOwner()
        );
        $linksField->setSortColumn('Sort');
        $linksField
            ->displayIf('BannerStyle')
            ->isEqualTo('links-list');

        $contentField = HTMLEditorField::create(
            'HTML',
            _t(
                'nswds.HTML',
                'Content'
            )
        );
        $contentField->setRows(6);


        $fields->addFieldsToTab("Root.Main", [
            $bannerStyleField,
            $bannerBrandingField,
            $contentField,
            $imageField,
            $linkField,
            $linksFieldTitle,
            $linksField
        ]);

    }

    #[\Override]
    public function onBeforeWrite()
    {
        parent::onBeforeWrite();
        /*
         * Backwards compatibility
         * AltStyle in 2.13 was interpreted as "light" by template
         * "--light" in v2.13 had no effect resulting in transparent (white)
         * "--light" in v2.14 is light blue, so reset to no brand if AltStyle is enabled in a one-off move
         * Future update will remove the AltStyle field
         */
        if ($this->getOwner()->AltStyle == 1) {
            $this->getOwner()->BannerBrand = self::BRAND_NONE;
            $this->getOwner()->AltStyle = 0;// turn off
        }
    }

}
