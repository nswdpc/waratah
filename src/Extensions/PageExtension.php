<?php

namespace NSWDPC\Waratah\Extensions;

use Page;
use SilverStripe\Control\Director;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\FieldGroup;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DateField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\View\ArrayData;

/**
 * @property ?string $Abstract
 * @property bool $ShowAbstractOnPage
 * @property bool $IsLandingPage
 * @property bool $ShowSectionNav
 * @property bool $ShowBannerImage
 * @property bool $HideBreadcrumbs
 * @property bool $DisableLastUpdated
 * @property ?string $PublicLastUpdated
 * @property bool $ShowBackToTop
 * @property int $ImageID
 * @method \SilverStripe\Assets\Image Image()
 */
class PageExtension extends DataExtension
{
    private static array $allowed_file_types = ["jpg", "jpeg", "gif", "png", "webp"];

    /**
     * Show LastEdited date on page
     *
     * @config
     */
    private static bool $show_last_updated = false;

    /**
     * Set LastEdited date format
     *
     * @config
     */
    private static string $date_format = 'dd LLLL y';

    private static array $db = [
        'Abstract' => 'Text',
        'ShowAbstractOnPage' => 'Boolean',
        'IsLandingPage' => 'Boolean',
        'ShowSectionNav' => 'Boolean',
        'ShowBannerImage' => 'Boolean',
        'HideBreadcrumbs' => 'Boolean',
        'DisableLastUpdated' => 'Boolean',
        'PublicLastUpdated' => 'Date',
        'ShowBackToTop' => 'Boolean'
    ];

    private static array $defaults = [
        "ShowAbstractOnPage" => 1,
        "HideBreadcrumbs" => 0,
        "ShowBackToTop" => 0
    ];

    private static array $has_one = [
        "Image" => Image::class
    ];

    private static array $owns = ["Image"];

    public function getAllowedFileTypes(): array
    {
        $types = $this->getOwner()->config()->get("allowed_file_types");
        if (empty($types)) {
            $types = ['jpg', 'jpeg', 'gif', 'png', 'webp'];
        }
        return array_unique($types);
    }

    /**
     * Return the sidebar navigation parent for the current page or null if none exists
     */
    public function getSidebarNavigation(int $level = 1): ?SiteTree
    {
        $parent = null;
        if (!($parent = $this->getOwner()->getSidebarSectionParent())) {
            $parent = $this->getOwner()->Level($level);
        }

        if ($parent) {
            $children = $parent->Children();
            if ($children && $children->count() > 0) {
                return $parent;
            }
        }

        return null;
    }

    /**
     * Get the sidebar section parent, which may be a parent of this record
     * Returns the parent record, or false
     * @return SiteTree|bool
     */
    public function getSidebarSectionParent()
    {
        if ($this->getOwner()->isCurrent() && $this->getOwner()->ShowSectionNav == 1) {
            // Current record is set to show it's own children
            return $this->getOwner();
        } else {
            // Check parents in the hierarchy
            $page = Director::get_current_page();
            while ($page instanceof SiteTree && $page->exists()) {
                if ($page->owner->ShowSectionNav == 1) {
                    return $page;
                }

                $page = $page->Parent();
            }

            return false;
        }
    }

    #[\Override]
    public function updateCMSFields(FieldList $fields)
    {

        /** @var \SilverStripe\Forms\TextareaField $abstractField */
        $abstractField = TextareaField::create(
            'Abstract',
            _t('nswds.ABSTRACT', 'Abstract')
        )->setDescription('This will be displayed in listings and search results')
        ->setTargetLength(160, 90, 200);

        $fields->insertAfter(
            'MenuTitle',
            $abstractField
        );

        $fields->insertAfter(
            'Abstract',
            CheckboxField::create(
                'ShowAbstractOnPage',
                _t('nswds.SHOWABSTRACT', 'Show abstract on the page, below the title')
            )
        );

        $fields->insertAfter(
            'ShowAbstractOnPage',
            CheckboxField::create(
                'IsLandingPage',
                _t('nswds.ISLANDINGPAGE', 'Show this page as a landing page')
            )->setDescription('This will remove any side navigation or other extras')
        );

        $fields->insertAfter(
            'IsLandingPage',
            CheckboxField::create(
                'ShowSectionNav',
                _t('nswds.SHOWSECTIONNAV', 'Show this page as a section')
            )->setDescription('This will remove pages at this level from the side navigaiton')
        );

        $fields->insertAfter(
            'ShowSectionNav',
            CheckboxField::create(
                'HideBreadcrumbs',
                _t('nswds.HIDEBREADCRUMBS', 'Hide standard breadcrumbs')
            )->setDescription("Use this option if you wish to hide breadcrumb navigation on this page, or if the page's template provides its own breadcrumbs")
        );

        $fields->addFieldsToTab("Root.Image", [
            UploadField::create(
                "Image",
                _t("nswds.SLIDE_IMAGE", "Image used for social media")
            )
            ->setAllowedExtensions($this->getOwner()->getAllowedFileTypes())
            ->setIsMultiUpload(false)
            ->setDescription(
                _t(
                    "nswds.ALLOWED_FILE_TYPES",
                    "Allowed file types: {types}",
                    [
                        'types' => implode(",", $this->getOwner()->getAllowedFileTypes())
                    ]
                )
            ),
            CheckboxField::create(
                'ShowBannerImage',
                _t('nswds.SHOWBANNERIMAGE', 'Show this image at top of the page as a banner')
            )

        ]);

    }

    public function updateSettingsFields(FieldList $fields)
    {

        $disableLastUpdated = FieldGroup::create(
            CheckboxField::create(
                'DisableLastUpdated',
                _t('nswds.DISABLELASTUPDATED', 'Disable last updated date on this page')
            )
        );
        $disableLastUpdated->setTitle('Last updated');
        $disableLastUpdated->setName('LastUpdatedGroup');

        $publicLastUpdated = FieldGroup::create(
            DateField::create(
                'PublicLastUpdated',
                _t('nswds.PUBLICLASTUPDATED', 'Show a custom last updated date')
            )
        );
        $publicLastUpdated->setName('PublicUpdatedGroup');

        $fields->insertAfter(
            'Visibility',
            $disableLastUpdated
        );

        $fields->insertAfter(
            'LastUpdatedGroup',
            $publicLastUpdated
        );

        // Add BackToTop button component
        $fields->insertBefore(
            'Visibility',
            CheckboxField::create(
                'ShowBackToTop',
                _t(
                    'nswds.SHOW_BACK_TO_TOP_BUTTON',
                    "Include the 'Back to top' button on the page"
                )
            )
        );

    }

    /**
     * Return Last Updated date for record, if enabled
     * If LastUpdated has no value, use record LastEdited value
     */
    public function PageLastUpdated(): ?ArrayData
    {
        $showLastUpdated = $this->getOwner()->config()->get('show_last_updated');
        $disableDateOnPage = $this->getOwner()->DisableLastUpdated;
        if (!$showLastUpdated || $disableDateOnPage) {
            return null;
        } else {
            $format = $this->getOwner()->config()->get('last_updated_format');
            $publicDateOnPage = $this->getOwner()->dbObject('PublicLastUpdated');
            $displayDate = $publicDateOnPage->getValue() ? $publicDateOnPage : $this->getOwner()->dbObject('LastEdited');
            return ArrayData::create([
                'Machine' => $displayDate->Format('yyyy-MM-dd'),
                'Human' => $displayDate->Format($format)
            ]);
        }
    }
}
