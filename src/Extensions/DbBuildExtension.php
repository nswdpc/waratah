<?php

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\Core\Extension;
use SilverStripe\PolyExecution\PolyOutput;
use SilverStripe\Versioned\Versioned;

/**
 * Provides before/after build hooks
 * @author James
 * @extends \SilverStripe\Core\Extension<(\SilverStripe\Dev\Command\DbBuild & static)>
 */
class DbBuildExtension extends Extension
{
    protected static ?string $originalStage = null;

    /**
     * Handles before build versioned stage setting (to Versioned::DRAFT)
     */
    public function onBeforeBuild(PolyOutput $output, bool $populate = true, bool $testMode = false)
    {
        static::$originalStage = Versioned::get_stage();
        Versioned::set_stage(Versioned::DRAFT);
    }

    /**
     * Handles after build versioned stage resetting
     */
    public function onAfterBuild(PolyOutput $output, bool $populate = true, bool $testMode = false)
    {
        if (is_string(static::$originalStage)) {
            Versioned::set_stage(static::$originalStage);
        }
    }
}
