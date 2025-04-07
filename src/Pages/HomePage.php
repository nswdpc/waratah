<?php

namespace NSWDPC\Waratah\Pages;

class HomePage extends \Page
{
    private static string $singular_name = "Home page";

    private static string $plural_name = "Home pages";

    private static string $table_name = 'HomePage';

    /**
     * This page is a homepage
     */
    public function getIsHomePage(): int
    {
        return 1;
    }
}
