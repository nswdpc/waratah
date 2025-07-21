<?php

namespace NSWDPC\Waratah\Extensions;

use NSWDPC\Schema\SpecialAnnouncement\SpecialAnnouncement;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\DropdownField;
use SilverStripe\View\ArrayData;
use SilverStripe\View\TemplateGlobalProvider;

/**
 * @property ?string $AlertState
 * @extends \SilverStripe\ORM\DataExtension<(\NSWDPC\Schema\SpecialAnnouncement\SpecialAnnouncement & static)>
 */
class SpecialAnnouncementExtension extends DataExtension implements TemplateGlobalProvider
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

    /**
     * @inheritdoc
     */
    #[\Override]
    public static function get_template_global_variables()
    {
        return [
            'WaratahGlobalAlerts' => 'get_waratah_global_alerts'
        ];
    }

    /**
     * Return all special announcements that are marked for the current page or
     * are global
     */
    public static function get_waratah_global_alerts(): ?ArrayList
    {
        $announcements = SpecialAnnouncement::get_special_announcements();
        $announcements = $announcements->setQueriedColumns([
            'Title','IsGlobal','LinkID','ImageID',
            'AlertState','ShortDescription'
        ]);
        if($announcements->count() == 0) {
            return null;
        }

        $alerts = ArrayList::create();
        foreach($announcements as $announcement) {
            $linkURL = '';
            $linkTitle = '';
            $link = $announcement->Link();
            if($link && $link->isInDB()) {
                $linkURL = $link->getLinkURL();
                $linkTitle = $link->Title;
            }

            $alerts->push(ArrayData::create([
                'GlobalAlert_AlertState' => $announcement->AlertState,
                'GlobalAlert_CookieName' => "_wrth_a_{$announcement->ID}",
                'GlobalAlert_Title' => $announcement->Title,
                'GlobalAlert_LinkURL' => $linkURL,
                'GlobalAlert_LinkTitle' => $linkTitle,
                'GlobalAlert_ButtonTitle' => $linkTitle,
                'GlobalAlert_Content' => $announcement->ShortDescription,
                'GlobalAlert_UseButtonLink' => true,
                'GlobalAlert_SchemaJSON' => null
            ]));
        }

        return $alerts;
    }

}
