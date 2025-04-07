<?php

namespace NSWDPC\Waratah\Extensions;

use DNADesign\Elemental\Models\ElementalArea;
use NSWDPC\Waratah\Models\SideElementalArea;
use NSWDPC\Waratah\Models\TopElementalArea;
use NSWDPC\Elemental\Models\Banner\ElementBanner;
use SilverStripe\Core\Convert;
use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\DB;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Tab;

/**
 * Extension applied to Page and other Elemental supporting DataObject
 * You should also apply the ElementalAreaExtension to the same DataObject
 */
class MultipleElementalAreaExtension extends DataExtension
{
    /**
     * @var array
     */
    private static $has_one = [
        'SideElementalArea' => ElementalArea::class,
        'TopElementalArea' => ElementalArea::class,
    ];

    /**
     * Publish elements when page published
     */
    private static $owns = [
        'SideElementalArea',
        'TopElementalArea'
    ];

    /**
     *
     * When we duplicate the page, we also want to duplicate the Elemental Area and Blocks
     */
    private static $cascade_duplicates = [
        'SideElementalArea',
        'TopElementalArea'
    ];

    /**
     * @var array
     */
    private static $allowed_side_elements = [];

    /**
     * @var array
     */
    private static $allowed_top_elements = [
        ElementBanner::class => ''
    ];

    /**
     * @var mixed
     */
    private $_cache_has_side_elements = null;

    /**
     * @var mixed
     */
    private $_cache_has_top_elements = null;

    /**
     * Ensure the records are correctly applied, when the owner is saved
     * As ensureElementalAreasExist creates ElementalArea classes only and not a subclass
     */
    public function onAfterWrite()
    {
        parent::onAfterWrite();
        $this->ensureCorrectSettings();
    }

    /**
     * Whenever this record is written, ensure the correct settings are applied
      * TODO: possibly better to do this outside the ORM to avoid writing a new version of each ElementalArea on every owner write event
     * @access private
     */
    private function ensureCorrectSettings()
    {

        // Settings for side area
        /** @var \DNADesign\Elemental\Models\ElementalArea $side */
        $side = $this->getOwner()->SideElementalArea();
        if (!empty($side->ID)) {
            $side->IsSideArea = 1;
            $side->IsTopArea = 0;
            // side elements do not have containers
            $side->AllowContainer = 0;
            $side->AllowSectionModification = 0;
            $side->RenderElementDirectly = 1;
            $side->write();
        }

        // Settings for top area
        /** @var \DNADesign\Elemental\Models\ElementalArea $top */
        $top = $this->getOwner()->TopElementalArea();
        if (!empty($top->ID)) {
            $top->IsSideArea = 0;
            $top->IsTopArea = 1;
            //elements in this area are expected to render their own containers, if required
            $top->AllowContainer = 0;
            $top->AllowSectionModification = 0;
            $top->RenderElementDirectly = 1;
            $top->write();
        }

        // Settings for the main area
        /** @var \DNADesign\Elemental\Models\ElementalArea $main */
        $main = $this->getOwner()->ElementalArea();
        if (!empty($main->ID)) {
            $main->IsSideArea = 0;
            $main->IsTopArea = 0;
            // on landing pages, main content elements *may* have a container
            $main->AllowContainer = 1;
            // and they may have section backgrounds
            $main->AllowSectionModification = 1;
            $main->RenderElementDirectly = 0;
            $main->write();
        }
    }

    /**
     * Return whether the owner has side elements
     * Rely on cache value if not null, to avoid DB hits
     */
    public function HasSideElements(): bool
    {
        if (is_null($this->_cache_has_side_elements)) {
            $this->_cache_has_side_elements = $this->owner->SideElementalArea()->Elements()->count() > 0;
        }
        return $this->_cache_has_side_elements;
    }

    /**
     * Return whether the owner has top elements
     * Rely on cache value if not null to avoid DB hits
     */
    public function HasTopElements(): bool
    {
        if (is_null($this->_cache_has_top_elements)) {
            $this->_cache_has_top_elements = $this->owner->TopElementalArea()->Elements()->count() > 0;
        }
        return $this->_cache_has_top_elements;
    }

    /**
     * Add additional elements to the CMS fields
     */
    public function updateCMSFields(FieldList $fields)
    {

        /** @var \DNADesign\Elemental\Forms\ElementalAreaField $top */
        $top = $fields->dataFieldByName('TopElementalArea');
        if ($top) {
            $topTypes = $this->owner->config()->get('allowed_top_elements');
            if (is_array($topTypes) && !empty($topTypes)) {
                $top->setTypes($topTypes);
            }
            $fields->removeByName('TopContent');
            $fields->insertAfter(
                'Main',
                Tab::create(
                    'TopContent',
                    _t('nswds.TOP_CONTENT', 'Top content')
                )
            );
            $fields->addFieldToTab('Root.TopContent', $top);
        }

        /** @var \DNADesign\Elemental\Forms\ElementalAreaField $sidebar */
        $sidebar = $fields->dataFieldByName('SideElementalArea');
        if ($sidebar) {
            $sideTypes = $this->owner->config()->get('allowed_side_elements');
            if (is_array($sideTypes) && !empty($sideTypes)) {
                $sidebar->setTypes($sideTypes);
            }
            $fields->removeByName('SideContent');
            $fields->insertAfter(
                'Main',
                Tab::create(
                    'SideContent',
                    _t('nswds.SIDE_CONTENT', 'Side content')
                )
            );
            $fields->addFieldToTab('Root.SideContent', $sidebar);
        }

    }

}
