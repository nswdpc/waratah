<?php

namespace NSWDPC\Waratah\Models;

use DNADesign\Elemental\Models\ElementContent;
use SilverStripe\Forms\TextField;

/**
 * Implement NSWDS Show More component as a content block that can be placed in pages
 * @property ?string $SummaryText
 * @property ?string $ToggleSuffix
 */
class ElementalShowMore extends ElementContent
{

    private static bool $inline_editable = true;

    private static string $table_name = 'ElementalShowMore';

    private static string $singular_name = 'Show more (NSW Design System)';

    private static string $plural_name = 'Show more (NSW Design System)';

    private static string $description = 'Create a show more component';

    private static string $icon = 'font-icon-block-promo-2';

    private static array $db = [
        'SummaryText' => 'Varchar',
        'ToggleSuffix' => 'Varchar',
    ];

    #[\Override]
    public function getType()
    {
        return _t(static::class . '.BlockType', 'Show more (NSW Design System)');
    }

    #[\Override]
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->insertBefore(
            'HTML',
            TextField::create(
                'SummaryText',
                _t(
                    'nswds.SHOW_MORE_SUMMARY_LABEL',
                    "Summary text to show before 'Show more' and 'Show less'"
                )
            )
        );
        $fields->insertAfter(
            'HTML',
            TextField::create(
                'ToggleSuffix',
                _t(
                    'nswds.SHOW_MORE_TOGGLE_SUFFIX_LABEL',
                    "Text to show after 'Show more' and 'Show less'"
                )
            )->setDescription(
                _t(
                    'nswds.SHOW_MORE_TOGGLE_SUFFIX_DESCRIPTION',
                    "By default this is only shown to screen readers, to give users context about the content that will be shown."
                )
            )
        );
        return $fields;
    }

}
