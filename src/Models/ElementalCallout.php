<?php

namespace NSWDPC\Waratah\Models;

use DNADesign\Elemental\Models\ElementContent;
use NSWDPC\Waratah\Traits\DesignSystemComponent;
use SilverStripe\Assets\Storage\DBFile;

/**
 * Implement NSWDS Callout component
 */
class ElementalCallout extends ElementContent
{
    use DesignSystemComponent;

    private static bool $inline_editable = true;

    private static string $table_name = 'ElementalCallout';

    private static string $singular_name = 'Callout';

    private static string $plural_name = 'Callout';

    private static string $description = 'Create a callout component';

    private static string $icon = 'font-icon-nswds';

    #[\Override]
    public function getType()
    {
        return _t(static::class . '.BlockType', 'Callout (NSW Design System)');
    }

    #[\Override]
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $imageField = $fields->dataFieldByName('ContentImage');
        if ($imageField) {
            $imageField->setDescription(
                htmlspecialchars(_t('nswds.IMAGE_MUST_BE_SQUARE', 'The callout component requires a square image. Images without a 1:1 aspect ratio will be resized.'))
            );
        }

        return $fields;
    }

    /**
     * Return the image resized to 48x48 dimensions
     */
    public function Image(): ?DBFile
    {
        $image = $this->ContentImage();
        if ($image && $image->exists()) {
            return $image->Fill(48, 48);
        }

        return null;
    }

    /**
     * @todo support Pictograms
     */
    public function Pictogram(): null
    {
        return null;
    }

}
