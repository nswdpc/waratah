# Documentation

+ [Build the frontend](./#build-the-frontend)
+ [Integration](./002_integration.md)
+ [Branding](./100_branding.md)
+ [Advanced configuration](./101_advanced_configuration)

## Build

After installation, you will need to build the frontend assets using one of our build processes. The build steps are:

1. Build the frontend assets, initially and when required during development
1. Optional: add CSS customisation if your project demands
1. Add/update theme configuration
1. Run the standard Silverstripe dev/build when required

### 1. Build the frontend assets 

You can build the frontend in a variety of ways, depending on your build system toolkit.

The `buildall` target script in package.json defines how distribution assets are created in a `themes/app/frontend/dist` directory, which is automatically [vendor-exposed](https://github.com/silverstripe/vendor-plugin) upon installation of this module.

This module does not ship built assets in version control. Your deployment build process should create these for distribution.

#### Requirements

node >= 18 / npm >= 8

#### Build directly via npm

```shell
npm --prefix ./vendor/nswdpc/waratah/themes/nswds/app/frontend run-script buildall
```

#### Build directly via yarn

```shell
yarn --cwd ./vendor/nswdpc/waratah/themes/nswds/app/frontend run buildall
```

#### Use build.sh

The build.sh shell script uses `npm` on the system to run the buildall script:

```shell
./vendor/nswdpc/waratah/build.sh
```

If you see `Error: npm is not installed on host` this means the script could not find npm on the system you are running the script on. The script expects `npm` to be in the PATH environment variable.

#### Composer scripts

For deeper integration into `composer`, the project can use the following scripts to build on demand or after the project is created.

```json
"scripts": {
    "post-create-project-cmd": [
        "NSWDPC\\Waratah\\Services\\Composer::postCreateProject"
    ],
    "build-nswds": [
        "NSWDPC\\Waratah\\Services\\Composer::buildDesignSystem"
    ]
}
```

The `post-create-project-cmd` scripts will run after `composer create-project` is called to assist with initial build.

When the module is updated or installed `composer run-script build-nswds` should be run.

Both script targets run ./build.sh which expects npm to be available.

#### Loading CSS and JS assets

Once built, assets are available in the `vendor/nswdpc/waratah/themes/nswds/app/frontend/dist` location. This path is vendor-exposed in `composer.json` and automatically exposed when the module is installed.

After build you will notice a `waratah-branding` directory in the project root. This is created by the build process and allows further branding customisation.

Development environments will automatically load non-minified assets.

### 2. Optional: add CSS customisation

Customisation can be added to `waratah-branding/frontend/src/app.scss` via your own SCSS/CSS.

This is important if your project is applying co-branding. See [Branding](./100_branding.md) documentation for more information.

### 3. Add theme configuration

> This is a once-only step during project creation.

Each Silverstripe project needs a theme configuration specified in the project's `app` configuration file.

This change should be committed to version control. You can use your own naming scheme in the configuration file.

```yaml
# app/_config/theme.yml
---
Name: app-theme
---
SilverStripe\View\SSViewer:
  themes:
    - 'nswdpc/waratah:nswds'
    - '$default'
```

If you have a custom theme in your project that provides custom templates, specify that before `nswdpc/waratah:nswds` 

```yaml
# app/_config/theme.yml
---
Name: app-theme
---
SilverStripe\View\SSViewer:
  themes:
    - 'my-agency-theme'
    - 'nswdpc/waratah:nswds'
    - '$default'
```

The project will then prefer templates from `themes/my-agency-theme/templates`.

### 4. Silverstripe dev/build

After building the assets, run a dev/build and a flush in the normal Silverstripe way:

```shell
./vendor/framework/sake dev/build flush=1
```

Depending on your project, you may also need to bypass/flush your browser cache.

## Subsequent builds

When updating the module, project modules or your project requirements in `waratah-branding` as you develop, simply run the required build steps.

## Further branding / custom integration

If you are co-branding or more, read [further branding customisation](./100_branding.md)
