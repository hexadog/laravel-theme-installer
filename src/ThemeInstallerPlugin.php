<?php

namespace Hexadog\LaravelThemeInstaller;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class ThemeInstallerPlugin implements PluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function activate(Composer $composer, IOInterface $io)
    {
        $installer = new ThemeInstaller($io, $composer);

        $composer->getInstallationManager()->addInstaller($installer);
    }

	/**
     * {@inheritdoc}
     */
	public function deactivate(Composer $composer, IOInterface $io)
	{
		// 
	}

	/**
     * {@inheritdoc}
     */
	public function uninstall(Composer $composer, IOInterface $io)
	{
		// 
	}
}
