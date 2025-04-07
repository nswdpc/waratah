<?php

namespace NSWDPC\Waratah\Pages;

class HomePage extends \Page
{
    /**
     * @var string
     */
    private static $singular_name = "Home page";

    /**
     * @var string
     */
    private static $plural_name = "Home pages";

    private static $table_name = 'HomePage';

    /**
     * This page is a homepage
     */
    public function getIsHomePage()
    {
        return 1;
    }
}
