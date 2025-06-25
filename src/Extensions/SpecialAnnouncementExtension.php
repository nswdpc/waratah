<?php

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\DropdownField;

/**
 * @property ?string $AlertState
 * @extends \SilverStripe\ORM\DataExtension<(\NSWDPC\Schema\SpecialAnnouncement\SpecialAnnouncement & static)>
 */
class SpecialAnnouncementExtension extends DataExtension
{
    private static array $db = [
        'AlertState' => 'Varchar(16)'
    ];

    #[\Override]
    public function updateCMSFields(FieldList $fields)
    {

        $fields->insertBefore(
            'Category',
            DropdownField::create(
                'AlertState',
                _t('nswds.ALERT_STATE', 'Alert state'),
                [
                    'default' => _t('nswds.DEFAULT_ALERT', 'Default alert'),
                    'critical' => _t('nswds.CRITICAL_ALERT', 'Critical alert'),
                    'light' => _t('nswds.LIGHT_ALERT', 'Light alert')
                ]
            )
        );

    }

}
