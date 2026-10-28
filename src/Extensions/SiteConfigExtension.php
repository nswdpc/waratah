<?php

namespace NSWDPC\Waratah\Extensions;

use NSWDPC\Waratah\Forms\FooterBrandSelectionField;
use SilverStripe\Assets\File;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Core\Extension;
use SilverStripe\Security\Permission;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Forms\Tab;
use SilverStripe\Forms\TabSet;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use gorriecoe\Link\Models\Link;
use gorriecoe\LinkField\LinkField;
use SilverStripe\LinkField\Models\Link as CoreLink;
use SilverStripe\LinkField\Form\MultiLinkField as CoreMultiLinkField;
use SilverStripe\LinkField\Form\LinkField as CoreLinkField;

/**
 * @property ?string $CopyrightOwner
 * @property ?string $FooterLinksCol1Title
 * @property ?string $FooterLinksCol2Title
 * @property ?string $FooterLinksCol3Title
 * @property ?string $FooterLinksCol4Title
 * @property ?string $FooterContent
 * @property ?string $FooterBrand
 * @property bool $DisplayWelcomeToCountry
 * @property mixed $WelcomeToCountry
 * @property bool $EnableTextToSpeech
 * @property ?string $LongTitle
 * @property int $LogoSVGID
 * @property int $LogoImageID
 * @method \SilverStripe\Assets\File LogoSVG()
 * @method \SilverStripe\Assets\File LogoImage()
 * @method \SilverStripe\ORM\ManyManyList<\gorriecoe\Link\Models\Link> FooterLinksCol1()
 * @method \SilverStripe\ORM\ManyManyList<\gorriecoe\Link\Models\Link> FooterLinksCol2()
 * @method \SilverStripe\ORM\ManyManyList<\gorriecoe\Link\Models\Link> FooterLinksCol3()
 * @method \SilverStripe\ORM\ManyManyList<\gorriecoe\Link\Models\Link> FooterLinksCol4()
 * @method \SilverStripe\ORM\ManyManyList<\gorriecoe\Link\Models\Link> FooterLinksSub()
 * @method \SilverStripe\ORM\ManyManyList<\gorriecoe\Link\Models\Link> SocialLinks()
 * @extends \SilverStripe\Core\Extension<(\SilverStripe\SiteConfig\SiteConfig & static)>
 * @property int $BuiltByID
 * @method \SilverStripe\LinkField\Models\Link BuiltBy()
 * @method \SilverStripe\ORM\HasManyList<\SilverStripe\LinkField\Models\Link> CoreFooterLinksCol1()
 * @method \SilverStripe\ORM\HasManyList<\SilverStripe\LinkField\Models\Link> CoreFooterLinksCol2()
 * @method \SilverStripe\ORM\HasManyList<\SilverStripe\LinkField\Models\Link> CoreFooterLinksCol3()
 * @method \SilverStripe\ORM\HasManyList<\SilverStripe\LinkField\Models\Link> CoreFooterLinksCol4()
 * @method \SilverStripe\ORM\HasManyList<\SilverStripe\LinkField\Models\Link> CoreFooterLinksSub()
 * @method \SilverStripe\ORM\HasManyList<\SilverStripe\LinkField\Models\Link> CoreSocialLinks()
 */
class SiteConfigExtension extends Extension
{
    private static array $db = [

        // Copyright and ownership
        'CopyrightOwner' => 'Varchar(255)',

        // global settings
        'FooterLinksCol1Title' => 'Varchar(255)',
        'FooterLinksCol2Title' => 'Varchar(255)',
        'FooterLinksCol3Title' => 'Varchar(255)',
        'FooterLinksCol4Title' => 'Varchar(255)',
        'FooterContent' => 'HTMLText',
        'FooterBrand' => 'Varchar(16)',
        'DisplayWelcomeToCountry' => 'Boolean',
        'WelcomeToCountry' => 'Text',

        // Accessibility
        'EnableTextToSpeech' => 'Boolean',

        // Long Title, allow wrapping
        'LongTitle' => 'Text'

    ];

    private static array $has_one = [
        'LogoSVG' => File::class,
        'LogoImage' => File::class,
        'BuiltBy' => CoreLink::class,
    ];

    private static array $owns = [
        'LogoSVG',
        'LogoImage',
        'CoreFooterLinksCol1',
        'CoreFooterLinksCol2',
        'CoreFooterLinksCol3',
        'CoreFooterLinksCol4',
        'CoreFooterLinksSub',
        'CoreSocialLinks',
        'BuiltBy'
    ];

    private static array $many_many = [
        'FooterLinksCol1' => Link::class,
        'FooterLinksCol2' => Link::class,
        'FooterLinksCol3' => Link::class,
        'FooterLinksCol4' => Link::class,
        'FooterLinksSub' => Link::class,
        'SocialLinks' => Link::class
    ];

    private static array $many_many_extraFields = [
        'FooterLinksCol1' => ['Sort' => 'Int'],
        'FooterLinksCol2' => ['Sort' => 'Int'],
        'FooterLinksCol3' => ['Sort' => 'Int'],
        'FooterLinksCol4' => ['Sort' => 'Int'],
        'FooterLinksSub' => ['Sort' => 'Int'],
        'SocialLinks' => ['Sort' => 'Int']
    ];

    private static array $has_many = [
        // migrated links
        'CoreFooterLinksCol1' => CoreLink::class . '.Owner',
        'CoreFooterLinksCol2' => CoreLink::class . '.Owner',
        'CoreFooterLinksCol3' => CoreLink::class . '.Owner',
        'CoreFooterLinksCol4' => CoreLink::class . '.Owner',
        'CoreFooterLinksSub' => CoreLink::class . '.Owner',
        'CoreSocialLinks' =>  CoreLink::class . '.Owner',
    ];

    private static array $cascade_deletes = [
        'CoreFooterLinksCol1',
        'CoreFooterLinksCol2',
        'CoreFooterLinksCol3',
        'CoreFooterLinksCol4',
        'CoreFooterLinksSub',
        'CoreSocialLinks',
        'BuiltBy'
    ];

    private static array $cascade_duplicates = [
        'CoreFooterLinksCol1',
        'CoreFooterLinksCol2',
        'CoreFooterLinksCol3',
        'CoreFooterLinksCol4',
        'CoreFooterLinksSub',
        'CoreSocialLinks',
        'BuiltBy'
    ];

    private static array $defaults = [
        'DisplayWelcomeToCountry' => 1
    ];

    /**
     * Apply fields to the settings model
     */
    public function updateCMSFields(FieldList $fields)
    {

        // add copyright notice
        $fields->addFieldsToTab(
            'Root.Main',
            [
                TextField::create('CopyrightOwner', 'Copyright notice')
            ]
        );

        $admin = Permission::check('ADMIN');
        if ($admin) {
            $fields->addFieldsToTab(
                'Root.Main',
                [
                    UploadField::create('LogoSVG', 'SVG version of site logo'),
                    UploadField::create('LogoImage', 'Image version of site logo')
                ]
            );
        }

        $fields->addFieldToTab(
            'Root',
            TabSet::create(
                'Footer',
                _t('nswds.FOOTER', 'Footer'),
                [
                    Tab::create(
                        'Main',
                        _t('nswds.MAIN', 'Main')
                    ),
                    Tab::create(
                        'Navigation',
                        _t('nswds.NAVIGATION', 'Navigation')
                    ),
                    Tab::create(
                        'Social',
                        _t('nswds.SOCIAL', 'Social')
                    ),
                    Tab::create(
                        'Content',
                        _t('nswds.CONTENT', 'Content')
                    )
                ]
            )
        );

        $fields->removeByName(['BuiltBy']);
        $fields->addFieldsToTab(
            'Root.Footer.Main',
            [
                FooterBrandSelectionField::create(
                    'FooterBrand',
                    _t('nswds.BRAND', 'Brand')
                ),
                CoreLinkField::create(
                    'BuiltBy',
                    _t(self::class . ".BUILT_BY_TITLE", "Built by")
                )
            ]
        );

        $navigationLinks = [
            'FooterLinksCol1',
            'FooterLinksCol2',
            'FooterLinksCol3',
            'FooterLinksCol4',
            'FooterLinksSub'
        ];

        // handle link fields
        foreach ($navigationLinks as $navigationLink) {

            // remove fields, added to composites
            $fields->removeByName([
                $navigationLink,
                "Core" . $navigationLink,
                $navigationLink . "ID",
                "Core" . $navigationLink . "ID"
            ]);

            $fields->addFieldToTab(
                'Root.Footer.Navigation',
                $this->getLinkFieldForRelation($navigationLink)
            );
        }

        // Single SocialLinks relation
        $fields->removeByName([
            "SocialLinks",
            "CoreSocialLinks",
            "SocialLinksID"
        ]);
        $fields->addFieldToTab(
            'Root.Footer.Social',
            $this->getLinkFieldForRelation('SocialLinks')
        );

        $fields->addFieldsToTab(
            'Root.Footer.Content',
            [
                CheckboxField::create(
                    'DisplayWelcomeToCountry',
                    _t('nswds.DISPLAY_WELCOME_TO_COUNTRY', "Display 'Welcome to Country' text")
                ),
                TextareaField::create(
                    'WelcomeToCountry',
                    _t('nswds.WELCOME_TO_COUNTRY_TITLE', 'Welcome to Country')
                ),
                HTMLEditorField::create(
                    'FooterContent',
                    _t(
                        'nswds.FOOTER_CONTENT',
                        'Footer content'
                    )
                )->setRows(6)
            ]
        );

        // enable TTS library, whatever that is
        $fields->addFieldsToTab(
            'Root.Accessibility',
            [
                CheckboxField::create(
                    'EnableTextToSpeech',
                    _t('nswds.ENABLE_TEXT_TO_SPEECH', 'Enable text to speech')
                )
            ]
        );

        // Provide alternative long title to allow for long names, used sparingly
        $fields->insertAfter(
            'Title',
            TextareaField::create(
                'LongTitle',
                _t('nswds.TITLE_WITH_BREAKS', 'Longer form of site title')
            )->setRows(2)
            ->setDescription(
                _t('nswds.TITLE_WITH_BREAKS_DESCRIPTION', 'Used in header, if provided')
            )
        );
    }

    /**
     * Get the default Welcome To Country / Acknowledgement of Country message
     */
    public function getWelcomeToCountry()
    {
        $value = $this->getOwner()->getField('WelcomeToCountry');
        if (!$value) {
            return _t(
                'nswds.WELCOME_TO_COUNTRY',
                'We pay respect to the Traditional Custodians and First Peoples of NSW, and acknowledge their continued connection to their country and culture.'
            );
        }

        return $value;
    }

    /**
     * Get the relevant link field based on the migration state of a link
     * @param string $relationName the name of a link e.g TravelBans
     */
    public function getLinkFieldForRelation(string $relationName): CompositeField
    {

        $linksCompositeField = CompositeField::create()
            ->setTitle($this->getLinkDescription($relationName));

        $linksCompositeField->push(
            TextField::create(
                $relationName . 'Title',
                _t('nswds.TITLE', 'Title')
            )
        );

        // the new links field always shows (migration target)
        $linksCompositeField->push(
            CoreMultiLinkField::create(
                'Core' . $relationName,
                _t(self::class . ".LINKS", "Links")
            )
        );

        // Legacy field, only show if there are actual unmigrated links remaining
        if ($this->getOwner()->getManyManyComponents($relationName)->filter(['IsMigrated' => 0])->count() > 0) {
            $linksCompositeField->push(
                LinkField::create(
                    $relationName,
                    _t(self::class . ".LINKS", "Links") . " " . _t(self::class . ".LINKS_LEGACY", "(legacy)"),
                    $this->getOwner()
                )->setSortColumn('Sort')
            );
        }

        return $linksCompositeField;
    }

    /**
     * Template method
     * @param string $relationName the Link relation
     */
    public function LinksList(string $relationName): \SilverStripe\Model\List\SS_List
    {
        return $this->getLinksList($relationName);
    }

    /**
     * Returns the relevant list of links based on a relation name
     */
    public function getLinksList(string $relationName): \SilverStripe\Model\List\SS_List
    {

        // core link relation is a has many
        $coreLinks = $this->getOwner()->getComponents('Core' . $relationName)->sort(['Sort' => 'ASC']);
        // legacy is a many many
        $unmigratedLinks = $this->getOwner()->getManyManyComponents($relationName)->filter(['IsMigrated' => 0]);
        if ($unmigratedLinks->count() == 0) {
            // all migrated, show all core links found
            return $coreLinks;
        }

        $result = \SilverStripe\Model\List\ArrayList::create();
        // get all new 'core' record links
        foreach ($coreLinks as $coreLink) {
            $result->push($coreLink);
        }

        // add on any unmigrated records
        foreach ($unmigratedLinks as $unmigratedLink) {
            // not yet migrated
            $result->push($unmigratedLink);
        }

        // return sorted result
        return $result->sort(['Sort' => 'ASC']);
    }

    /**
     * Return metadata about the links, for field labels and such
     */
    public function getLinkDescriptions(): array
    {
        return [
            'FooterLinksCol1' => _t(self::class . '.FOOTER_LINK_COLUMN_1', 'Column one'),
            'FooterLinksCol2' => _t(self::class . '.FOOTER_LINK_COLUMN_1', 'Column two'),
            'FooterLinksCol3' => _t(self::class . '.FOOTER_LINK_COLUMN_1', 'Column three'),
            'FooterLinksCol4' => _t(self::class . '.FOOTER_LINK_COLUMN_1', 'Column four'),
            'FooterLinksSub' => _t(self::class . '.FOOTER_LINK_LOWER_LEVEL', 'Lower level'),
            'SocialLinks' => _t(self::class . '.FOOTER_LINK_SOCIAL_MEDIA', 'Social media links'),
        ];
    }

    /**
     * Return metadata for one link defined by a key
     */
    public function getLinkDescription(string $key): string
    {
        $descriptions = $this->getLinkDescriptions();

        return $descriptions[ $key ] ?? "";
    }

    /**
     * Return whether at least one set of the main footer links 1-4 is available
     */
    public function HasFooterLinks(): bool
    {
        $navigationLinks = [
            'FooterLinksCol1',
            'FooterLinksCol2',
            'FooterLinksCol3',
            'FooterLinksCol4'
        ];
        foreach ($navigationLinks as $navigationLink) {
            $links = $this->getLinksList($navigationLink);
            if ($links->count() > 0) {
                return true;
            }
        }

        return false;
    }

}
