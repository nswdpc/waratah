<?php

declare(strict_types=1);

namespace NSWDPC\Waratah\Pages;

/**
 * @extends \PageController<\NSWDPC\Waratah\Pages\HomePage>
 */
class HomePageController extends \PageController
{
    public function IsHomePage(): bool
    {
        return true;
    }
}
