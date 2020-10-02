# Laravel Theme Installer
This package is a fork of [Laravel Module Installer](https://github.com/joshbrw/laravel-module-installer) to work with Theme packages.
It allows installation of standalone Theme package into the `Themes/` directory instead of `vendor/`.

You can specify an alternate directory by including a `theme-dir` in the extra data in your composer.json file:

    "extra": {
        "theme-dir": "Custom"
    }

## Installation

1. Ensure you have the `type` set to `laravel-theme` in your module's `composer.json`
2. Require this package: `composer require hexadog/laravel-theme-installer`
3. Require your bespoke theme using Composer

## Notes

* When working on a theme that is version controlled within an app that is also version controlled, you have to commit and push from inside the Theme directory and then `composer update` within the app itself to ensure that the latest version of your theme (dependant upon constraint) is specified in your composer.lock file.
