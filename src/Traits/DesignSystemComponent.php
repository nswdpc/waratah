<?php

declare(strict_types=1);

namespace NSWDPC\Waratah\Traits;

/**
 * A trait that can be applied to classes that represent
 * NSW Design System components
 */
trait DesignSystemComponent
{
    public function isNswDesignSystemComponent(): bool
    {
        return true;
    }

}
