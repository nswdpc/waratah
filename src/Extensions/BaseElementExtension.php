<?php

namespace NSWDPC\Waratah\Extensions;

use NSWDPC\Waratah\Models\DesignSystemConfiguration;
use NSWDPC\Waratah\Forms\SectionSelectionField;
use NSWDPC\Waratah\Traits\DesignSystemSelections;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\CheckboxField;

/**
 * Provide additional elemental integration with DS
 * @author Mark Taylor
 * @author James Ellis
 * @property ?string $HeadingLevel
 * @property bool $ShowInMenus
 * @property bool $AddContainer
 * @property ?string $AddBackground
 * @property bool $IsBoxed
 * @property ?string $VerticalSpacing
 * @extends \SilverStripe\ORM\DataExtension<(\DNADesign\Elemental\Models\BaseElement & static)>
 */
class BaseElementExtension extends DataExtension
{
    use DesignSystemSelections;

    /**
     * AddBackround - the options light-10,light-20,light-40 are nswds v2.13 options and will be deprecated in v1.0.
     * The AddBackground option '1' is a legacy option that triggered 'light-10' background. This now triggers 'off-white'
     * The AddBackground value of 0, the default, produces a nsw-section without suffixed classes
     * See the getBackground method which templates should use to retrieve the correct background class for the section ({$Background})
     */
    private static array $db = [
        'HeadingLevel' => 'Varchar(4)',
        'ShowInMenus'  => 'Boolean',
        'AddContainer' => 'Boolean',
        'AddBackground' => "Varchar(64)", // nsw-section--<branding>
        'IsBoxed' => 'Boolean',// nsw-section--box
        'VerticalSpacing' => "Varchar(32)" // // nsw-section--<padding>
    ];

    /**
     * By default all elements have a container, elements not on landing/full width pages
     * will ignore the container value and never be in a container, in any case
     */
    private static array $defaults = [
        'AddContainer' => 1,
        'AddBackground' => 0,
        'IsBoxed' => 0,
        'VerticalSpacing' => null,// default
    ];

    private static array $headings = [
        'h3' => 'Heading Three',
        'h4' => 'Heading Four',
        'h5' => 'Heading Five',
        'h6' => 'Heading Six',
    ];

    /**
     * @deprecated v1.0
     */
    private static array $backgrounds = [
        'white' => 'White',
        'light-10' => 'Light 10',
        'light-20' => 'Light 20',
        'light-40' => 'Light 40',
    ];

    /**
     * Use Reflection to get the element shortname for a CSS class
     */
    public function ElementShortName(): string
    {
        $rc = new \ReflectionClass($this->getOwner());
        $short = $rc->getShortName();
        return strtolower((string) preg_replace("[^A-Za-z_0-9]", "", $short));
    }

    /**
     * Add CMS fields for element
     */
    #[\Override]
    public function updateCMSFields(FieldList $fields)
    {

        $fields->removeByName(['ExtraClass']);

        $fields->insertAfter(
            'Title',
            CheckboxField::create(
                'ShowInMenus',
                _t(
                    'nswds.SHOW_THIS_ELEMENT_IN_ON_THIS_PAGE_MENUS',
                    'Show in "On this page" menus?'
                )
            )
        );

        $headings = $this->getOwner()->config()->get('headings');
        if (!is_array($headings)) {
            $headings = [];
        }

        $fields->addFieldToTab(
            'Root.Settings',
            DropdownField::create(
                'HeadingLevel',
                _t(
                    'nswds.HEADING_LEVEL_OVERRIDE',
                    'Heading level override'
                ),
                $headings
            )->setEmptyString('Default (Heading Two)')
        );

        $fields->addFieldsToTab(
            'Root.Display',
            [
                CheckboxField::create(
                    'AddContainer',
                    _t(
                        'nswds.ADD_CONTAINER_TO_BLOCK',
                        'Add a container to this block'
                    )
                )->setDescription(
                    _t(
                        'nswds.IGNORED_ON_CERTAIN_PAGES',
                        "Applicable to landing page 'Main content' area, only."
                    )
                ),
                SectionSelectionField::create(
                    'AddBackground',
                    _t(
                        'nswds.ADD_BACKGROUND',
                        'Add a background to this block'
                    )
                )->setDescription(
                    _t(
                        'nswds.BACKGROUND_APPLICATION_NOTES',
                        "Backgrounds are applied to blocks in the landing page 'Main content' area, only."
                    )
                )->setRightTitle(
                    _t(
                        'nswds.BACKGROUND_EXAMPLE',
                        'Example default section backgrounds are available at {exampleURL}',
                        [
                            'exampleURL' => 'https://designsystem.nsw.gov.au/core/section/index.html'
                        ]
                    )
                ),
                DropdownField::create(
                    'VerticalSpacing',
                    _t(
                        'nswds.VERTICAL_SPACING_TITLE',
                        'Specify optional vertical spacing for this block'
                    ),
                    [
                        'half-padding' => _t('nswds.HALF_PADDING', 'Half vertical spacing'),
                        'no-padding' => _t('nswds.NO_PADDING', 'No vertical spacing'),
                    ]
                )->setDescription(
                    _t(
                        'nswds.VERTICAL_SPACING_APPLICATION_NOTES',
                        'If no spacing is selected, the default spacing is used'
                    )
                )->setRightTitle(
                    _t(
                        'nswds.VERTICAL_SPACING_EXAMPLE',
                        'Spacing examples are available at {exampleURL}',
                        [
                            'exampleURL' => 'https://designsystem.nsw.gov.au/core/section/index.html'
                        ]
                    )
                )->setEmptyString(_t('nswds.SELECT_OPTION', 'Select an option')),
                CheckboxField::create(
                    'IsBoxed',
                    _t(
                        'nswds.IS_BOXED',
                        'Apply an outline to this block'
                    )
                )->setDescription(
                    _t(
                        'nswds.IS_BOXED_DESCRIPTION',
                        'Outlines are applied to blocks on non-landing pages, only.'
                    )
                )
            ]
        );

    }

    /**
     * Return an array of available backgrounds
     * See: https://designsystem.nsw.gov.au/core/section/index.html
     */
    protected function getBackgrounds(): array
    {
        $backgrounds = $this->getColourSelectionOptions('section');
        if (!is_array($backgrounds)) {
            $backgrounds = [];
        }

        return $backgrounds;
    }

    /**
     * Return the supported background value, if it exists
     * Return an empty string if the value is not supported
     */
    protected function getSupportedBackground(string $bg): string
    {
        $backgrounds = $this->getBackgrounds();
        return array_key_exists($bg, $backgrounds) ? $bg : '';
    }

    /**
     * Return the nswds background value or an empty value if not supported
     * https://designsystem.nsw.gov.au/core/section/index.html
     * Use by a template as $Background
     * Invert is automatically added when a dark BG is selected
     */
    public function getBackground(): string
    {
        $bg = $this->getOwner()->AddBackground;
        $bg = $this->getSupportedBackground(strval($bg));

        $spacing = DesignSystemConfiguration::get_spacing_class();
        $invert = DesignSystemConfiguration::is_invert_background($bg);
        $classes = [];
        // nsw-section
        $classes[] = 'nsw-section';
        if ($bg !== '') {
            $classes[] = 'nsw-section--' . $bg;
            if ($spacing !== '') {
                $classes[] = $spacing;
            }
        } elseif ($spacing !== '') {
            $classes[] = $spacing;
        }

        if ($invert) {
            $classes[] = "nsw-section--invert";
        }

        return implode(" ", $classes);
    }

}
