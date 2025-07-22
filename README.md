# NSW Design System integration for Silverstripe websites

This module integrates the [NSW Design System](https://github.com/digitalnsw/nsw-design-system) with a Silverstripe website and handles all the branding requirements for building a NSW Government website.

If you are a NSW Government agency using, or thinking of using, [Silverstripe Framework and/or CMS](https://silverstripe.org) this is the module to get you started.

This module is maintained by the PD Digital Team. We're a friendly crew that welcomes pull/merge requests and issue reports via Github.

## Features

+ ✅ Implements all components from the NSW Design System v3
+ ✅ Branding: full support for Masterbrand, Co-brand and Independent entities within [the NSW branding guidelines](https://designsystem.nsw.gov.au/core/logo/index.html).
+ ✅ [Aboriginal colour palette support](./docs/en/102_aboriginal_colour_palette.md)
+ ✅ **BSD-3 licensed**. Can be used in all projects, including proprietary projects.
+ ✅ Completely extendable using standard development practices via Silverstripe templating, configuration and Composer module management
+ ✅ Standard page layouts based on [template examples](https://designsystem.nsw.gov.au/templates/index.html)
+ ✅ Integrates our supported [Elemental content blocks](https://github.com/silverstripe/silverstripe-elemental)
+ ✅ Includes our [Silverstripe content authoring boilerplate](https://github.com/nswdpc/silverstripe-content-boilerplate) containing our supported content authoring tools.
+ ✅ Form building - supports all Silverstripe form fields plus our supported form field extensions
+ ✅ Adds SlimSelect for `<select multiple>` support - [see documentation](./docs/en/005_components.md)
+ ✅ [A simple frontend build process using Yarn or NPM](./docs/en/001_index.md)
+ ✅ Themes and templates: supports adding project-specific JS and SCSS requirements to the build, including templates and settings overrides
+ ✅ Custom branding, theming and templating available via build system and standard Silverstripe template/theme integration
+ ✅ [Extra components](./docs/en/005_extra_components.md)
+ ✅ Can be easily integrated into your development stack
+ ✅ Can be easily integrated with your CI/CD, audit and change management processes.

## Installation

Starting within a standard Silverstripe installation, install via [Composer](https://getcomposer.org/download/) in your chosen development environment.

### Silverstripe >= 5

Read [important changes in ^2](./docs/en/006_v2_changes.md)

```sh
composer require nswdpc/waratah:^2
```

### Silverstripe >= 4.13.0

```sh
composer require nswdpc/waratah:~1.1.0
```

[Previous version history](./docs/en/404_previous_versions.md)

## After installation and next steps

Next 👉 [building the frontend assets](./docs/en/001_index.md)

## License

[BSD-3-Clause](./LICENSE.md)

## Documentation

* [Further documentation](./docs/en/001_index.md)

## Configuration

See [_config directory](./_config) for default configuration settings

## Maintainers

PD web team

## Security

If you have found a security issue with this module, please email digital[@]dpc.nsw.gov.au in the first instance, detailing your findings.

## Bugtracker

We welcome bug reports, pull requests and feature requests on the Github Issue tracker for this project.

Please review the [code of conduct](./code-of-conduct.md) prior to opening a new issue.

## Development and contribution

If you would like to make contributions to the module please ensure you raise a pull request and discuss with the module maintainers.

Please review the [code of conduct](./code-of-conduct.md) prior to completing a pull request.
