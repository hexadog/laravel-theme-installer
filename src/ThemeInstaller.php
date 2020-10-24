<?php

namespace Hexadog\LaravelThemeInstaller;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;

class ThemeInstaller extends LibraryInstaller
{
    /**
     * {@inheritdoc}
     */
    public function supports($packageType)
    {
        return $packageType === 'laravel-theme';
    }

    /**
     * {@inheritdoc}
     */
    public function getInstallPath(PackageInterface $package)
    {
        return $this->getBaseInstallationPath() . DIRECTORY_SEPARATOR . $this->getThemeName($package);
    }

    /**
     * Get the base path that the module should be installed into.
     * Defaults to Modules/ and can be overridden in the module's composer.json.
     * @return string
     */
    protected function getBaseInstallationPath()
    {
        if ($this->composer && $this->composer->getPackage()) {
            $extra = $this->composer->getPackage()->getExtra();

            if (array_key_exists('theme-dir', $extra)) {
                return $extra['theme-dir'];
            }
        }

        return 'themes';
    }
    
    /**
     * Get the theme name
     *      "something" => "something"
     *      "vendor-name/something" => "something"
     *      "vendor-name/something-theme" => "something"
     * @param PackageInterface $package
     * @return string
     * @throws \Exception
     */
    protected function getThemeName(PackageInterface $package)
    {
        return str_replace('-theme', '', str_replace('theme-', '', $package->getPrettyName()));
    }
}
