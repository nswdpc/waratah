<?php

namespace NSWDPC\Waratah\Models\EditableFormField;

use gorriecoe\Link\Models\Link;
use NSWDPC\InlineLinker\InlineLinkField;
use SilverStripe\Admin\LeftAndMain;
use SilverStripe\Control\Controller;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\TextField;
use SilverStripe\UserForms\Model\EditableFormField\EditableLiteralField;

/**
 * Provide a callout field for use in user defined forms
 * This field is rendered via nswds/Callout template
 * @author James
 */
class EditableCalloutField extends EditableLiteralField
{
    /**
     * @var string
     */
    private static $singular_name = 'Callout (NSW Design System)';

    /**
     * @var string
     */
    private static $plural_name = 'Callouts (NSW Design System)';

    /**
     * @var string
     */
    private static $table_name = 'EditableCalloutField';

    /**
     * Mark as literal only
     *
     * @config
     * @var bool
     */
    private static $literal = true;

    /**
     * @var array
     */
    private static $db = [
        'IconCode' => 'Varchar(64)'
    ];

    /**
     * @var array
     */
    private static $defaults = [
        'HideLabel' => 1,
        'HideFromReports' => 1
    ];

    /**
     * @var array
     */
    private static $has_one = [
        'Link' => Link::class
    ];

    /**
     * @inheritdoc
     */
    public function showInReports()
    {
        return false;
    }

    /**
     * @inheritdoc
     */
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
        $fields->removeByName('LinkID');
        $fields->insertAfter(
            'IconCode',
            $this->getLinkField()
        );

        $fields->removeByName(['HideLabel','HideFromReports']);

        return $fields;
    }

    /**
     * Get the link chooser field
     */
    public function getLinkField(): InlineLinkField
    {
        return InlineLinkField::create(
            'Link',
            _t('nswds.LINK', 'Link'),
            $this
        );
    }

    /**
     * Hide the label
     * @inheritdoc
     */
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
    public function getFormField()
    {

        if (Controller::curr() instanceof LeftAndMain) {
            // avoid theme issues with templates not being found
            $content = "";
        } else {
            $content = $this->renderWith(__CLASS__);
        }

        $field = LiteralField::create(
            "Callout-{$this->ID}]",
            $content
        );

        $this->doUpdateFormField($field);

        return $field;
    }

}
