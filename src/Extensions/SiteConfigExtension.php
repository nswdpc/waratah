<?php

namespace NSWDPC\Waratah\Extensions;

use NSWDPC\Waratah\Forms\FooterBrandSelectionField;
use SilverStripe\Assets\File;
use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Security\Permission;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HeaderField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\Tab;
use SilverStripe\Forms\TabSet;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\ORM\FieldType\DBHTMLText;
use gorriecoe\Link\Models\Link;
use gorriecoe\LinkField\LinkField;

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
 */
class SiteConfigExtension extends DataExtension
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
        'LogoImage' => File::class
    ];

    private static array $owns = [
        'LogoSVG',
        'LogoImage'
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

    private static array $defaults = [
        'DisplayWelcomeToCountry' => 1
    ];

    #[\Override]
    public function updateCMSFields(FieldList $fields)
    {

        // rm tabs
        $fields->removeByName([
            'FooterLinksCol1',
            'FooterLinksCol2',
            'FooterLinksCol3',
            'FooterLinksCol4',
            'FooterLinksSub',
            'SocialLinks'
        ]);

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

        $fields->addFieldToTab(
            'Root.Footer.Main',
            FooterBrandSelectionField::create(
                'FooterBrand',
                _t('nswds.BRAND', 'Brand')
            )
        );

        $fields->addFieldsToTab(
            'Root.Footer.Navigation',
            [
                CompositeField::create(
                    TextField::create('FooterLinksCol1Title', _t('nswds.TITLE', 'Title')),
                    LinkField::create(
                        'FooterLinksCol1',
                        _t('nswds.LINKS', 'Links'),
                        $this->getOwner()
                    )->setSortColumn('Sort')
                )->setTitle(_t('nswds.COLUMN_ONE', 'Column one')),

                CompositeField::create(
                    TextField::create('FooterLinksCol2Title', _t('nswds.TITLE', 'Title')),
                    LinkField::create(
                        'FooterLinksCol2',
                        _t('nswds.LINKS', 'Links'),
                        $this->getOwner()
                    )->setSortColumn('Sort')
                )->setTitle(_t('nswds.COLUMN_TWO', 'Column two')),

                CompositeField::create(
                    TextField::create('FooterLinksCol3Title', _t('nswds.TITLE', 'Title')),
                    LinkField::create(
                        'FooterLinksCol3',
                        _t('nswds.LINKS', 'Links'),
                        $this->getOwner()
                    )->setSortColumn('Sort'),
                )->setTitle(_t('nswds.COLUMN_THREE', 'Column three')),

                CompositeField::create(
                    TextField::create('FooterLinksCol4Title', _t('nswds.TITLE', 'Title')),
                    LinkField::create(
                        'FooterLinksCol4',
                        _t('nswds.LINKS', 'Links'),
                        $this->getOwner()
                    )->setSortColumn('Sort'),
                )->setTitle(_t('nswds.COLUMN_FOUR', 'Column four')),

                CompositeField::create(
                    LinkField::create(
                        'FooterLinksSub',
                        _t('nswds.LINKS', 'Links'),
                        $this->getOwner()
                    )->setSortColumn('Sort')
                )->setTitle(_t('nswds.LOWER_FOOTER_LEVEL', 'Lower level')),
            ]
        );

        $fields->addFieldsToTab(
            'Root.Footer.Social',
            [
                LinkField::create(
                    'SocialLinks',
                    'Social Media links',
                    $this->getOwner()
                )->setSortColumn('Sort')
            ]
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
     * Get the default
     */
    public function getWelcomeToCountry()
    {
        $value = $this->getOwner()->getField('WelcomeToCountry');
        if (!$value) {
            $value = _t(
                'nswds.WELCOME_TO_COUNTRY',
                'We pay respect to the Traditional Custodians and First Peoples of NSW, and acknowledge their continued connection to their country and culture.'
            );
        }

        return $value;
    }

}
