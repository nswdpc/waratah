<?php

namespace NSWDPC\Waratah\Extensions;

use NSWDPC\Waratah\Forms\HeroBannerBrandSelectionField;
use SilverStripe\Core\Extension;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use gorriecoe\Link\Models\Link;
use gorriecoe\LinkField\LinkField;
use SilverStripe\LinkField\Models\Link as CoreLink;
use SilverStripe\LinkField\Form\MultiLinkField as CoreMultiLinkField;
use UncleCheese\DisplayLogic\Forms\Wrapper;

/**
 * Design system integration for Banner element
 * @property ?string $BannerStyle
 * @property bool $AltStyle
 * @property ?string $BannerBrand
 * @property ?string $HTML
 * @property ?string $BannerLinksTitle
 * @method \SilverStripe\ORM\ManyManyList<\gorriecoe\Link\Models\Link> BannerLinks()
 * @extends \SilverStripe\Core\Extension<(\NSWDPC\Elemental\Models\Banner\ElementBanner & static)>
 * @method \SilverStripe\ORM\HasManyList<\SilverStripe\LinkField\Models\Link> CoreBannerLinks()
 */
class ElementBannerExtension extends Extension
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
        // legacy links
        'BannerLinks' => Link::class
    ];

    private static array $has_many = [
        // migrated links
        'CoreBannerLinks' => CoreLink::class . '.Owner'
    ];

    private static array $owns = [
        'CoreBannerLinks'
    ];

    private static array $cascade_deletes = [
        'CoreBannerLinks',
    ];

    private static array $cascade_duplicates = [
        'CoreBannerLinks',
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

    public function updateCMSFields(FieldList $fields)
    {

        $fields->removeByName([
            'BannerLinks', 'BannerLinksTitle',
            'CoreBannerLinks',
            'AltStyle'
        ]);

        // NSWDS style and branding options
        $bannerStyleField = DropdownField::create(
            'BannerStyle',
            _t('nswds.BANNERSTYLE', 'Layout'),
            $this->getOwner()->config()->get("banner_styles")
        );

        $bannerBrandingField = HeroBannerBrandSelectionField::create(
            'BannerBrand',
            _t('nswds.BANNERBRAND', 'Brand')
        );

        // the content field
        $contentField = HTMLEditorField::create(
            'HTML',
            _t(
                'nswds.HTML',
                'Content'
            )
        );
        $contentField->setRows(6);

        // Image for use in banner
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


        // BannerLink field provided by ElementBanner module
        // it's assumed link migration happens in ElementBanner module
        $linkField = $fields->dataFieldByName('BannerLink');
        $fields->removeByName(['BannerLink']);
        $linkField->setTitle(_t('nswds.LINK', 'Link'));
        // add the field to a Wrapper
        $linkFieldWrapper = Wrapper::create($linkField);
        $linkFieldWrapper
            ->displayIf('BannerStyle')
            ->isEqualTo('call-to-action')
            ->orIf()->isEqualTo('call-to-action-image');

        // BannerLinks
        // The new field is always shown, so a CMS author can migrate
        // (via LinkMigrationAdmin) and immediately manage the result here.
        $linksCompositeField = CompositeField::create([])
            ->setTitle(_t('nswds.LINKS', 'Links'));
        // text to use for the title of the banner links
        $linksCompositeField->push(
            TextField::create(
                'BannerLinksTitle',
                _t('nswds.LINKSTITLE', 'Title of link list'),
            )
        );
        // the new links field (migration target)
        $linksCompositeField->push(
            CoreMultiLinkField::create(
                'CoreBannerLinks',
                _t('nswds.LINKS', 'Links (new)')
            )
        );

        // Legacy field, only show if there are actual links remaining
        if ($this->getOwner()->BannerLinks()->count() > 0) {
            $linksCompositeField->push(
                LinkField::create(
                    'BannerLinks',
                    _t('nswds.LINKS', 'Links (legacy)'),
                    $this->getOwner()
                )->setSortColumn('Sort')
            );
        }

        // fire on display logic choice
        $linksFieldWrapper = Wrapper::create($linksCompositeField);
        $linksFieldWrapper->displayIf('BannerStyle')->isEqualTo('links-list');


        // apply fields to tabs
        $fields->addFieldsToTab("Root.Main", [
            $bannerStyleField,
            $bannerBrandingField,
            $contentField,
            $imageField,
            $linkFieldWrapper,// wrapper for single BannerLink
            $linksFieldWrapper // wrapper for multi BannerLinks
        ]);

    }

    public function onBeforeWrite()
    {
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

    /**
     * Template method for getBannerLinksList()
     */
    public function BannerLinksList(): \SilverStripe\Model\List\SS_List
    {
        return $this->getBannerLinksList();
    }

    /**
     * Returns the relevant list of links for the banner
     */
    public function getBannerLinksList(): \SilverStripe\Model\List\SS_List
    {

        $coreBannerLinks = $this->getOwner()->CoreBannerLinks()->sort(['Sort' => 'ASC']);
        $unmigratedBannerLinks = $this->getOwner()->BannerLinks()->filter(['IsMigrated' => 0]);
        if ($unmigratedBannerLinks->count() == 0) {
            // all migrated, show all core links found
            return $coreBannerLinks;
        }

        $result = \SilverStripe\Model\List\ArrayList::create();
        // get all new 'core' record links
        foreach ($coreBannerLinks as $coreBannerLink) {
            $result->push($coreBannerLink);
        }

        // add on any unmigrated records
        foreach ($unmigratedBannerLinks as $unmigratedBannerLink) {
            // not yet migrated
            $result->push($unmigratedBannerLink);
        }

        // return sorted result
        return $result->sort(['Sort' => 'ASC']);
    }

}
