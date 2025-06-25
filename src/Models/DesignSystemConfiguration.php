<?php

namespace NSWDPC\Waratah\Models;

use SilverStripe\Core\Config\Configurable;
use SilverStripe\Control\Controller;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\FieldType\DBHTMLText;
use SilverStripe\ORM\ValidationResult;
use SilverStripe\View\TemplateGlobalProvider;
use SilverStripe\View\SSViewer;

/**
 *
 * This is the configuration model for the NSW Design System integration provided by NSWDPC
 *
 * By default the DesignSystemAssetExtension will use the configuration values below
 * To override these in a project, for instance if your website is providing its own
 * app.js and app.css, modify the below to update the vendor/module and theme values
 * as required
 *
 * For example if you override the values to nswdpc/my-module and the them to my-theme:
 *
 * app.js will be picked up from _resources/vendor/nswdpc/my-module/themes/my-theme/app/frontend/dist/javascript/app.js
 * app.css will be picked up from _resources/vendor/nswdpc/my-module/themes/my-theme/app/frontend/dist/css/app.css
 *
 * If you set vendor and module to null, it's assumed that the path will be to a theme rather than vendor module:

 * app.js will be picked up from _resources/themes/my-theme/app/frontend/dist/javascript/app.js
 * app.css will be picked up from _resources/themes/my-theme/app/frontend/dist/css/app.css
 *
 * /dist files are located in the path app/frontend
 *
 * Your project must expose `themes/my-theme/app/frontend/dist` in composer.json:
 *
 * extra : {
 *   "expose": [
 *     "themes/my-theme/client/dist"
 *   ]
 * }
 *
 * Run `composer vendor-expose` to expose that path under public/_resources
 *
 * See DesignSystemAssetExtension getAsset() method for implementation
 *
 * If you ship a project with frontend_provided = true then it's expected that you have taken complete
 * control over frontend requirements and have injected  your own Extension over DesignSystemAssetExtension
 *
 *
 * @author James
 *
 */
class DesignSystemConfiguration implements TemplateGlobalProvider
{
    use Configurable;

    private static bool $frontend_provided = false;

    private static string $vendor = "nswdpc";

    private static string $module = "waratah";

    private static string $theme = "nswds";

    /**
     * @var string
     * Add spacing classes eg. "nsw-p-top-... nsw-p-bottom-..."
     * if required to supporting components
     */
    private static string $spacing_class = "";

    /**
     * @var string
     * The class to be used on element sections ->for landing pages<-
     * In other contexts, nsw-block would be used
     * Since v0.3.x (nswds 2.14.x), wrth-section has been dropped
     * @deprecated v1.0 the default section class is nsw-section
     */
    private static string $element_section_class = "";

    /*
     * @var float
     * This is a fun way to define some branding options in code
     */
    private static float $branding_version = 3.0;

    /**
     * Set whether masterband is on or off, if off you need to configure
     * a non masterband: cobrand, endorsed, independent
     */
    private static bool $masterbrand = true;

    /**
     * @var string
     * Co-Branding configuration, by default this is off
     * Applicable values are '','vertical' or 'horizontal'
     */
    private static string $co_branding = '';

    /**
     * @var string
     * Endorsed configuration, by default this is off
     * Applicable values are '','coupled' or 'decoupled'
     */
    private static string $endorsed = '';

    /**
     * @var string
     * Options are light or dark
     * Can be set to 'light' when co_branding outcomes demand it
     */
    private static string $masthead_brand = "dark";

    /**
     * @var array brand options
     * https://nswdesignsystem.surge.sh/styles/colour/index.html
     */
    private static array $colour_brand_options = [
        'dark' => 'Brand Dark',
        'light' => 'Brand Light',
        'supplementary' => 'Brand supplementary',
        'accent' => 'Brand Accent'
    ];

    /**
     * @var array card branding options
     * https://nswdesignsystem.surge.sh/components/card/index.html
     */
    private static array $colour_cardbrand_options = [
        'dark' => 'Brand Dark',
        'light' => 'Brand Light'
    ];

    /**
     * @var array media branding options
     * https://nswdesignsystem.surge.sh/components/media/index.html
     */
    private static array $colour_mediabrand_options = [
        'dark' => 'Brand Dark',
        'light' => 'Brand Light',
        'transparent' => 'Transparent'
    ];


    /**
     * @var array hero banner branding options
     * https://digitalnsw.github.io/nsw-design-system/components/hero-banner/index.html
     */
    private static array $colour_herobannerbrand_options = [
        'dark' => 'Brand Dark',
        'light' => 'Brand Light',
        'white' => 'White',
        'off-white' => 'Off White'
    ];

    /**
     * @var array alert state options
     * https://nswdesignsystem.surge.sh/components/site-wide-message/index.html
     */
    private static array $colour_alertstate_options = [
        '' => 'Information',
        'light' => 'Light',
        'critical' => 'Critical',
    ];

    /**
     * @var array alert state options
     * https://nswdesignsystem.surge.sh/components/notification/index.html
     */
    private static array $colour_notificationstate_options = [
        'info' => 'Information',
        'warning' => 'Warning',
        'error' => 'Critical',
        'success' => 'Success',
    ];

    /**
     * @var array card branding options
     * https://nswdesignsystem.surge.sh/components/button/index.html
     */
    private static array $colour_buttonstate_options = [
        'dark' => 'Brand Dark',
        'dark-outline' => 'Brand Dark Outline',
        'dark-outline-solid' => 'Brand Dark Outline Solid',
        'light' => 'Brand Light',
        'light-outline' => 'Brand Light Outline',
        'white' => 'White',
        'white-outline' => 'White Outline',
        'danger' => 'Danger'
    ];

    /**
     * @var array section options
     * https://nswdesignsystem.surge.sh/styles/section/index.html
     */
    private static array $colour_section_options = [
        'brand-dark' => 'Brand dark',
        'brand-light' => 'Brand light',
        'brand-supplementary' => 'Brand supplementary',
        'black' => 'Black',
        'white' => 'White',
        'off-white' => 'Off white',
        'grey-01' => 'Grey 01',
        'grey-02' => 'Grey 02',
        'grey-03' => 'Grey 03',
        'grey-04' => 'Grey 04'
    ];

    /**
     * @var array section options that can have invert applied
     */
    private static array $invert_section_options = [
        'brand-dark',
        'brand-supplementary',
        'black',
        'grey-01',
        'grey-02'
    ];

    /**
     * @var array hero banner branding options
     * https://digitalnsw.github.io/nsw-design-system/components/footer/index.html
     */
    private static array $colour_footerbrand_options = [
        'dark' => 'Brand Dark',
        'light' => 'Brand Light',
    ];

    /**
     * @var string
     * Allow alternate homepage, provided as URL or path
     */
    private static string $alt_home_page = "";

    /**
     * Configuration option for enabling jquery project-wide
     */
    private static bool $enable_jquery = false;

    /**
     * Return the configured spacing class, used to implement consistent spacing in a project
     */
    public static function get_spacing_class(): string
    {
        return self::config()->get('spacing_class');
    }

    /**
     * Return the configured element section class for
     */
    public static function get_element_section_class(): string
    {
        return self::config()->get('element_section_class');
    }

    /**
     * Return the backgrounds that support invert
     */
    public static function get_invert_backgrounds(): array
    {
        return self::config()->get('invert_section_options');
    }

    /**
     * Return whether the background supports invert
     */
    public static function is_invert_background(string $background): bool
    {
        $invertColours = self::get_invert_backgrounds();
        return in_array($background, $invertColours);
    }

    /**
     * Returns an array of strings of the method names of methods on the call that should be exposed
     * as global variables in the templates.
     *
     * @return array
     */
    #[\Override]
    public static function get_template_global_variables()
    {
        return [
            'Waratah_CoBrand' => 'waratah_cobrand',
            'Waratah_BrandVersion' => 'waratah_brandversion',
            'Waratah_Endorsed' => 'waratah_endorsed',
            'Waratah_Masterbrand' => 'waratah_masterbrand',
            'SpacingClass' => 'get_spacing_class',
            'ElementSectionClass' => 'get_element_section_class',
            'MastHead_Brand' => 'get_masthead_brand',
            'AlternateHomeURL' => 'get_alt_home_page',
            'PerLayoutContent' => 'get_per_layout_content',
            'FormAlertLevel' => 'get_alert_level'
        ];
    }

    /**
     * Return the NSWDS alert level based on input, default return is info
     * @param string $alertLevel
     */
    public static function get_alert_level($alertLevel): string
    {
        return match ($alertLevel) {
            'success', ValidationResult::TYPE_GOOD => 'success',
            ValidationResult::TYPE_WARNING => 'warning',
            'bad', 'required', ValidationResult::TYPE_ERROR => 'error',
            default => 'info',
        };
    }


    /**
     * Waratah masthead brand value
     * @return string
     */
    public static function get_masthead_brand()
    {
        return self::config()->get('masthead_brand');
    }

    /**
     * Waratah co brand value '' (default), 'vertical' or 'horizontal'
     * @return string
     */
    public static function waratah_cobrand()
    {
        return self::config()->get('co_branding');
    }

    /**
     * Waratah masterbrand value, default is true
     * @return bool
     */
    public static function waratah_masterbrand()
    {
        if (self::waratah_cobrand() || self::waratah_endorsed()) {
            // cobrand or endorsed cancel masterbrand
            return false;
        } else {
            return self::config()->get('masterbrand');
        }
    }

    /**
     * Waratah endorsed setting, the value is either empty '' (default), 'coupled' or 'decoupled'
     * @return string
     */
    public static function waratah_endorsed()
    {
        return self::config()->get('endorsed');
    }


    /**
     * Waratah branding version
     */
    public static function waratah_brandversion()
    {
        return self::config()->get('branding_version');
    }

    /*
     * Return the alternate home page URL or path, if configured
     */
    public static function get_alt_home_page(): string
    {
        return self::config()->get('alt_home_page');
    }

    /**
     * Return per layout content
     * Example: <% include NSWDPC/Waratah/PageWrapper PerLayoutContentTemplate='Template/Location/TheTemplate' %>
     * @param string $template an SS template path eg App/Directory/Person
     */
    public static function get_per_layout_content($template): ?DBHTMLText
    {
        $controller = Controller::has_curr() ? Controller::curr() : null;
        if (!$controller) {
            return null;
        }

        $chosenTemplate = SSViewer::chooseTemplate($template);
        if (!$chosenTemplate) {
            return null;
        }

        $viewer = SSViewer::create($template);
        // do not include requirements when parsing the template
        $viewer->includeRequirements(false);
        // process template with current controller
        $result = $viewer->process($controller, null, null);
        return DBField::create_field(
            DBHTMLText::class,
            $result
        );
    }

}
