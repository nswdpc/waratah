<?php

namespace NSWDPC\Waratah\Models\EditableFormField;

use gorriecoe\Link\Models\Link;
use gorriecoe\LinkField\LinkField;
use SilverStripe\LinkField\Models\Link as CoreLink;
use SilverStripe\LinkField\Form\LinkField as CoreLinkField;
use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\Control\Controller;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\TextField;
use SilverStripe\UserForms\Model\EditableFormField\EditableLiteralField;

/**
 * Provide a callout field for use in user defined forms
 * This field is rendered via nswds/Callout template
 * @author James
 * @property ?string $IconCode
 * @property int $LinkID
 * @method \gorriecoe\Link\Models\Link Link()
 * @property int $CoreLinkID
 * @method \SilverStripe\LinkField\Models\Link CoreLink()
 */
class EditableCalloutField extends EditableLiteralField
{
    private static string $singular_name = 'Callout (NSW Design System)';

    private static string $plural_name = 'Callouts (NSW Design System)';

    private static string $table_name = 'EditableCalloutField';

    /**
     * Mark as literal only
     *
     * @config
     */
    private static bool $literal = true;

    private static array $db = [
        'IconCode' => 'Varchar(64)'
    ];

    private static array $defaults = [
        'HideLabel' => 1,
        'HideFromReports' => 1
    ];

    private static array $has_one = [
        'Link' => Link::class,
        'CoreLink' => CoreLink::class
    ];

    private static array $owns = ['CoreLink'];

    private static array $cascade_deletes = [
        'CoreLink'
    ];

    private static array $cascade_duplicates = [
        'CoreLink'
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
     * @inheritdoc
     */
    #[\Override]
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->insertAfter(
            'Content',
            TextField::create(
                'IconCode',
                _t('nswds.ICON_CLASS', 'Material Design icon name')
            )->setDescription(
                _t(
                    'nswds.ICON_CLASS_DESCRIPTION',
                    'Find icons at {url}',
                    [
                        'url' => 'https://fonts.google.com/icons'
                    ]
                )
            )
        );

        $fields->removeByName(['LinkID', 'CoreLink']);
        $fields->insertAfter(
            'IconCode',
            $this->getLinkField()
        );

        $fields->removeByName(['HideLabel','HideFromReports']);

        return $fields;
    }

    /**
     * Return the field used to render the link
     * This handles migration to the core silverstripe/linkfield model
     */
    protected function getLinkField(): CoreLinkField|LinkField
    {
        $contentLink = $this->getDerivedLink();
        if ($contentLink instanceof CoreLink) {
            return CoreLinkField::create('CoreLink', _t('nswds.LINK', 'Link'));
        }

        return LinkField::create('Link', _t('nswds.LINK', 'Link'), $this);
    }

    /**
     * Template method for getDerivedLink
     */
    public function DerivedLink(): CoreLink|Link
    {
        return $this->getDerivedLink();
    }

    /**
     * Returns the migrated core Link if one exists, falling back to the
     * legacy gorriecoe Link otherwise. Use this (not Link()/LinkID)
     * anywhere the link is consumed - templates, controllers, other modules.
     * This handle migration to the core silverstripe/linkfield model
     */
    public function getDerivedLink(): CoreLink|Link
    {
        $coreLink = $this->CoreLink();
        /** @var Link $legacyLink */
        $legacyLink = $this->getComponent('Link');
        if ($coreLink->isInDB() || !$legacyLink->isInDB()) {
            return $coreLink;
        }

        return $legacyLink;
    }

    /**
     * Hide the label
     * @inheritdoc
     */
    #[\Override]
    public function onBeforeWrite()
    {
        parent::onBeforeWrite();
        $this->HideLabel = 1;
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
        $content = "";
        if (Controller::curr() instanceof ContentController) {
            // only render if page rendering
            $content = $this->renderWith(self::class);
        }

        $field = LiteralField::create(
            "Callout-{$this->ID}]",
            $content
        );

        $this->doUpdateFormField($field);

        return $field;
    }

}
