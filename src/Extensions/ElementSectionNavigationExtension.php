<?php

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\DropdownField;
use SilverStripe\ORM\SS_List;

/**
 * Provide decoration options for
 * {@link Dynamic\Elements\Section\Elements\ElementSectionNavigation}
 * @property ?string $CardColumns
 * @property ?string $CardStyle
 */
class ElementSectionNavigationExtension extends DataExtension
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
    #[\Override]
    public function updateCMSFields(FieldList $fields)
    {

        $cardColumns = DropdownField::create('CardColumns', _t(self::class . '.CARDCOLUMNS', 'Card columns'), $this->getOwner()->config()->card_columns);
        $cardColumns->setEmptyString('none');

        $cardStyle = DropdownField::create('CardStyle', _t(self::class . '.CARDSTYLE', 'Card style'), $this->getOwner()->config()->card_styles);
        $cardStyle->setEmptyString('none');

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
        $columns = $this->getOwner()->CardColumns;

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
    public function getSortedSectionNavigation(): ?SS_List
    {
        $list = $this->getOwner()->getSectionNavigation();
        if ($list) {
            return $list->sort('Sort');
        }

        return null;
    }

    /**
     * Determine if card is horizontal (promo)
     */
    public function getIsHorizontal(): bool
    {
        return $this->getOwner()->CardStyle == 'promo';
    }

    /**
     * Determine if abstract should be displayed
     */
    public function getShowAbstract(): bool
    {
        return $this->getOwner()->CardStyle != 'title';
    }

    /**
     * Determine if image should be displayed
     */
    public function getShowImage(): bool
    {
        return $this->getOwner()->CardStyle == 'promo' || $this->getOwner()->CardStyle == 'title-image-abstract';
    }

}
