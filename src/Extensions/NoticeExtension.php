<?php

namespace NSWDPC\Waratah\Extensions;

use NSWDPC\Notices\Notice;
use SilverStripe\Core\Convert;
use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\DB;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\FieldList;

/**
 * Extension for generic notice module/record
 * @author James
 */
class NoticeExtension extends DataExtension {

    /**
     * @var array
     */
    private static $db = [
        'IsAcknowledgementOfCountry' => 'Boolean'
    ];

    /**
     * @var array
     */
    private static $indexes = [
        'IsAcknowledgementOfCountry' => true
    ];

    /**
     * Post-write operations
     */
    public function onAfterWrite()
    {
        parent::onAfterWrite();
        if ($this->owner->IsAcknowledgementOfCountry == 1) {
            DB::query("UPDATE `SiteNotice` SET IsAcknowledgementOfCountry = 0 WHERE ID <> '" . Convert::raw2sql($this->owner->ID) . "'");
        }
    }

    /**
     * Extension method for specific styling opportunities
     */
    public function addExtraClass(array &$extraClasses) {
        if ($this->owner->IsAcknowledgementOfCountry == 1) {
            $extraClasses[] = 'wrth-mm-aoc';
        }
    }

    /**
     * @return void
     */
    public function updateCmsFields(FieldList $fields) {
        $fields->insertAfter(
            'Description',
            CheckboxField::create(
                'IsAcknowledgementOfCountry',
                _t('nswds.IS_AOC', 'This is the \'Acknowledgement Of Country\' notice')
            )->setDescription(
                _t(
                    'nswds.IS_AOC_DESCRIPTION',
                    'This option controls the  \'Site-wide notice\' option'
                )
            )
        );

        if($isGlobalField = $fields->dataFieldByName("IsGlobal")) {
            $isGlobalField = $isGlobalField->setRightTitle(
                _t(
                    'nswds.IS_GLOBAL_NOTICE_DESCRIPTION',
                    'Site-wide notices are shown on every page once per browser.'
                )
            );
        }
    }

}
