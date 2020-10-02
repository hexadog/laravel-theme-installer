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
		if (!$this->composer || !$this->composer->getPackage()) {
			return 'Themes';
		}

		$extra = $this->composer->getPackage()->getExtra();

		if (!$extra || empty($extra['theme-dir'])) {
			return 'Themes';
		}

		return $extra['theme-dir'];
	}
	
	/**
	 * Get the theme name
	 * 		"something" => "Something"
	 *		"vendor-name/something" => "Something"
	 * 		"vendor-name/something-theme" => "Something"
	 * @param PackageInterface $package
	 * @return string
	 * @throws \Exception
	 */
	protected function getThemeName(PackageInterface $package)
	{
		$name = $package->getPrettyName();
		$split = explode("/", $name);

		$splitNameToUse = explode("-", count($split) >= 2 ? $split[1] : $split[0]);

		return implode('', array_map('ucfirst', array_filter($splitNameToUse, function ($value) {
			return $value !== "theme";
		})));
	}
}
