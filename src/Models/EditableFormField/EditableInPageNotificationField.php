<?php

namespace NSWDPC\Waratah\Models\EditableFormField;

use gorriecoe\Link\Models\Link;
use NSWDPC\InlineLinker\InlineLinkField;
use NSWDPC\Waratah\Forms\NotificationStateSelectionField;
use SilverStripe\Admin\LeftAndMain;
use SilverStripe\Control\Controller;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\TextField;
use SilverStripe\UserForms\Model\EditableFormField\EditableLiteralField;

/**
 * Provide a InPageNotification field for use in user defined forms
 * This field is rendered via nswds/InPageNotification template
 * @author James
 * @property ?string $NotificationLevel
 */
class EditableInPageNotificationField extends EditableLiteralField
{
    private static string $singular_name = 'In-page alert (NSW Design System)';

    private static string $plural_name = 'In-page alerts (NSW Design System)';

    private static string $table_name = 'EditableInPageNotificationField';

    /**
     * Mark as literal only
     *
     * @config
     */
    private static bool $literal = true;

    private static array $db = [
        'NotificationLevel' => 'Varchar(16)'
    ];

    private static array $defaults = [
        'HideLabel' => 0,
        'HideFromReports' => 1,
        'NotificationLevel' => 'info'
    ];

    /**
     * @inheritdoc
     */
    #[\Override]
    public function showInReports()
    {
        return false;
    }

    /**
     * Return icon based on state
     */
    public function getIconCode(): string
    {
        return NotificationStateSelectionField::getIconCode($this->NotificationLevel);
    }

    /**
     * @inheritdoc
     */
    #[\Override]
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->insertAfter(
            'Content',
            NotificationStateSelectionField::create(
                'NotificationLevel',
                _t('nswds.NOTIFICATION_LEVEL', 'Alert level')
            )->setDescription(
                _t(
                    'nswds.NOTIFICATION_LEVEL_DESCRIPTION',
                    'The icon used is determined by the level selected'
                )
            )
        );

        $fields->removeByName(['HideFromReports']);

        if ($hideLabelField = $fields->dataFieldByName('HideLabel')) {
            $hideLabelField->setTitle(
                _t(
                    'nswds.HIDE_TITLE_IN_NOTIFICATION',
                    'Do not show the title in the alert'
                )
            );
            $fields->insertAfter(
                'Title',
                $hideLabelField
            );
        }

        return $fields;
    }

    /**
     * Hide the label
     * @inheritdoc
     */
    #[\Override]
    public function onBeforeWrite()
    {
        parent::onBeforeWrite();
        $this->HideFromReports = 1;
    }

    /**
     * @inheritdoc
     * Render this element into the nswds Callout include,
     * returned as a LiteralField
     */
    #[\Override]
    public function getFormField()
    {

        if (Controller::curr() instanceof LeftAndMain) {
            // avoid theme issues with templates not being found
            $content = "";
        } else {
            $content = $this->renderWith(self::class);
        }

        $field = LiteralField::create(
            "InPageAlert-{$this->ID}]",
            $content
        );

        $this->doUpdateFormField($field);

        return $field;
    }

}
