<?php

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\DropdownField;
use SilverStripe\ORM\SS_List;

/**
 * Provide decoration options for
 * {@link Dynamic\Elements\Section\Elements\ElementSectionNavigation}
 */
class ElementSectionNavigationExtension extends DataExtension
{

    /**
     * @var array
     */
    private static $db = [
        'CardColumns' => 'Varchar(64)',
        'CardStyle' => 'Varchar(64)'
    ];

    /**
     * @var array
     */
    private static $card_columns = [
        '2' => 'Two',
        '3' => 'Three',
        '4' => 'Four',
    ];

    /**
     * @var array
     */
    private static $card_styles = [
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

        $cardColumns = DropdownField::create('CardColumns',_t(__CLASS__ . '.CARDCOLUMNS','Card columns'),$this->owner->config()->card_columns);
        $cardColumns->setEmptyString('none');

        $cardStyle = DropdownField::create('CardStyle',_t(__CLASS__ . '.CARDSTYLE','Card style'),$this->owner->config()->card_styles);
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
    public function getColumns() : ?string
    {
        $columns = $this->owner->CardColumns;

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
    public function getSortedSectionNavigation() : ?SS_List {
        $list = $this->owner->getSectionNavigation();
        if($list) {
            $list = $list->sort('Sort');
            return $list;
        }
        return null;
    }

    /**
     * Determine if card is horizontal (promo)
     */
    public function getIsHorizontal() : bool {
        return $this->owner->CardStyle == 'promo';
    }

    /**
     * Determine if abstract should be displayed
     */
    public function getShowAbstract() : bool {
        return $this->owner->CardStyle != 'title';
    }

    /**
     * Determine if image should be displayed
     */
    public function getShowImage() : bool {
        return $this->owner->CardStyle == 'promo' || $this->owner->CardStyle == 'title-image-abstract';
    }

}
