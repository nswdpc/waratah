<?php

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
