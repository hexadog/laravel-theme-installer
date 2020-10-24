# Laravel Theme Installer
[![Latest Stable Version](https://poser.pugx.org/hexadog/laravel-theme-installer/v)](//packagist.org/packages/hexadog/laravel-theme-installer) [![Total Downloads](https://poser.pugx.org/hexadog/laravel-theme-installer/downloads)](//packagist.org/packages/hexadog/laravel-theme-installer) [![License](https://poser.pugx.org/hexadog/laravel-theme-installer/license)](//packagist.org/packages/hexadog/laravel-theme-installer)


This package is a fork of [Laravel Module Installer](https://github.com/joshbrw/laravel-module-installer) to work with Theme packages.
It allows installation of standalone Theme package into the `themes/` directory instead of `vendor/`.

For example if your Theme package name is `hexadog/admin-theme` then the package will be installed into `themes/hexadog/admin` directory.

You can specify an alternate directory by including a `theme-dir` in the extra data in your composer.json file:

    "extra": {
        "theme-dir": "custom"
    }

## Installation

1. Ensure you have the `type` set to `laravel-theme` in your theme's `composer.json`
2. Require this package: `composer require hexadog/laravel-theme-installer`
3. Require your bespoke theme using Composer

## Notes

When working on a theme that is version controlled within an app that is also version controlled, you have to commit and push from inside the Theme directory and then `composer update` within the app itself to ensure that the latest version of your theme (dependant upon constraint) is specified in your composer.lock file.

## Related projects
- [Laravel Themes Manager](https://github.com/hexadog/laravel-themes-manager): Develop multi-themes Laravel application with ease.
