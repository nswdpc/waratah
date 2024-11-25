<?php

use NSWDPC\Waratah\Controllers;

use NSWDPC\Waratah\Models\SupportList;
use SilverStripe\Admin\ModelAdmin;

/**
 * Model admin for NSWDS/Waratah models
 */
class ArAdmin extends ModelAdmin
{
    /**
     * @inheritdoc
     */
    private static string $url_segment = 'waratah';

    /**
     * @inheritdoc
     */
    private static string $menu_title = 'NSW Design System';

    /**
     * @inheritdoc
     */
    private static string $menu_icon = 'nswdpc/waratah:themes/nswds/app/static/nsw-digital-logos/favicon/favicon-16x16.png';

    /**
     * @inheritdoc
     */
    private static array $managed_models = [
        SupportList::class
    ];

}
