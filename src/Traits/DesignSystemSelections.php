<?php

namespace NSWDPC\Waratah\Traits;

use NSWDPC\Waratah\Models\DesignSystemConfiguration;

/**
 * Common methods for retrieving configuration selection options
 */
trait DesignSystemSelections
{
    /**
     * Return an array of options for use in a branding/palette selection field
     */
    public function getColourSelectionOptions(string $key): array
    {
        $configKey = "colour_{$key}_options";
        $options = DesignSystemConfiguration::config()->get($configKey);
        if (!is_array($options)) {
            $options = [];
        }
        return $options;
    }

}
