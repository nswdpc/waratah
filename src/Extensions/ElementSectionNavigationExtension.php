<?php

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\Core\Config\Config;
use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Model\List\ArrayList;
use SilverStripe\ORM\DataList;

/**
 * Provide decoration options for
 * {@link Dynamic\Elements\Section\Elements\ElementSectionNavigation}
 * @property ?string $CardColumns
 * @property ?string $CardStyle
 * @extends \SilverStripe\Core\Extension<(\Dynamic\Elements\Section\Elements\ElementSectionNavigation & static)> @phpstan-ignore class.notFound
 */
class ElementSectionNavigationExtension extends Extension
{
    private static array $db = [
        'CardColumns' => 'Varchar(64)',
        'CardStyle' => 'Varchar(64)'
    ];

    private static array $card_columns = [
        '2' => 'Two',
        '3' => 'Three',
        '4' => 'Four',
    ];

    private static array $card_styles = [
        'title' => 'Title only',
        'title-abstract' => 'Title and abstract',
        'title-image-abstract' => 'Title, image, abstract',
        'promo' => 'Title, image, abstract (horizontal)'
    ];

    /**
     * Implement CMS fields for card display
     */
    public function updateCMSFields(FieldList $fields)
    {

        /** @var \Dynamic\Elements\Section\Elements\ElementSectionNavigation $owner */
        /** @phpstan-ignore class.notFound */
        $owner = $this->getOwner();
        $cardColumns = DropdownField::create(
            'CardColumns',
            _t(
                self::class . '.CARDCOLUMNS',
                'Card columns'
            ),
            /** @phpstan-ignore class.notFound */
            Config::inst()->get($owner::class, 'card_columns')
        )->setEmptyString(_t('nswds.NONE', 'none'));

        $cardStyle = DropdownField::create(
            'CardStyle',
            _t(
                self::class . '.CARDSTYLE',
                'Card style'
            ),
            /** @phpstan-ignore class.notFound */
            Config::inst()->get($owner::class, 'card_styles')
        )->setEmptyString(_t('nswds.NONE', 'none'));

        $fields->addFieldsToTab(
            'Root.Main',
            [
                $cardColumns,
                $cardStyle
            ]
        );

    }

    /**
     * @todo this should implement the grid-helpers handling
     */
    public function getColumns(): ?string
    {

        /** @var \Dynamic\Elements\Section\Elements\ElementSectionNavigation $owner */
        /** @phpstan-ignore class.notFound */
        $owner = $this->getOwner();
        /** @phpstan-ignore class.notFound */
        $columns = $owner->CardColumns;

        if ($columns == 2) {
            return "nsw-col-sm-6";
        }

        if ($columns == 3) {
            return "nsw-col-md-4";
        }

        if ($columns == 4) {
            return "nsw-col-sm-6 nsw-col-md-4 nsw-col-lg-3";
        }

        return null;

    }

    /**
     * Return the section navigation sorted by the Sort order in SiteTree
     */
    public function getSortedSectionNavigation(): DataList|ArrayList|null
    {
        /** @var \Dynamic\Elements\Section\Elements\ElementSectionNavigation $owner */
        /** @phpstan-ignore class.notFound */
        $owner = $this->getOwner();
        /** @phpstan-ignore class.notFound */
        $list = $owner->getSectionNavigation();
        if ($list instanceof DataList || $list instanceof ArrayList) {
            return $list->sort(['Sort' => 'ASC']);
        }

        return null;
    }

    /**
     * Template method for self::getSortedSectionNavigation()
     */
    public function SortedSectionNavigation(): DataList|ArrayList|null
    {
        return $this->getSortedSectionNavigation();
    }

    /**
     * Determine if card is horizontal (promo)
     */
    public function getIsHorizontal(): bool
    {
        /** @var \Dynamic\Elements\Section\Elements\ElementSectionNavigation $owner */
        /** @phpstan-ignore class.notFound */
        $owner = $this->getOwner();
        /** @phpstan-ignore class.notFound */
        return $owner->CardStyle == 'promo';
    }

    /**
     * Determine if abstract should be displayed
     */
    public function getShowAbstract(): bool
    {
        /** @var \Dynamic\Elements\Section\Elements\ElementSectionNavigation $owner */
        /** @phpstan-ignore class.notFound */
        $owner = $this->getOwner();
        /** @phpstan-ignore class.notFound */
        return $owner->CardStyle != 'title';
    }

    /**
     * Determine if image should be displayed
     */
    public function getShowImage(): bool
    {
        /** @var \Dynamic\Elements\Section\Elements\ElementSectionNavigation $owner */
        /** @phpstan-ignore class.notFound */
        $owner = $this->getOwner();
        /** @phpstan-ignore class.notFound, class.notFound */
        return $owner->CardStyle == 'promo' || $owner->CardStyle == 'title-image-abstract';
    }

}
