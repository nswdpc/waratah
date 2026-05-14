## v2 changes

The following changes were/will-be made in v2.0.0

1. nswdpc/silverstripe-notification-boilerplate is no longer shipped with this module. You can install it separately if required.
1. jQuery is no longer included by default. To enable jQuery inclusion as before, add `\NSWDPC\Waratah\Models\DesignSystemConfiguration.enable_jquery: true` in your project's YAML configuration (see Silverstripe configuration documentation for how to do this). If you don't do this, and you need jQuery in your project, please include it in your project.
1. Please review module changes and removals in the module requirements, [especially changes in the `nswdpc/silverstripe-content-boilerplate` module](https://github.com/nswdpc/silverstripe-content-boilerplate/blob/master/docs/en/001_index.md)
1. (watch this space for more changes)
