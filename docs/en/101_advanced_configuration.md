# Advanced Configuration

> Standard template override information can be found in [branding documentation](./100_branding.md).

:warning: It's assumed you know what you are doing when modifying these options. If you find a bug with it, please let us know in the Github issues.

## Different build location

If you want to go further and are providing your own theme build, you can configure a different theme target in your project configuration Yaml:

```yaml
NSWDPC\Waratah\Models\DesignSystemConfiguration:
  vendor: 'me'
  module: 'some-module'
  theme: 'my-specific-theme'
```

The system will look for built app.js and app.css in `vendor/me/some-module/themes/my-specific-theme/app/frontend/dist`

## Even more advanced configuration:

Ignore all asset and requirement loading using `frontend_provided: true`. It's assumed you are providing your own method of delivering the built NSW Design System assets.

```yaml
NSWDPC\Waratah\Models\DesignSystemConfiguration:
  frontend_provided: true
```
