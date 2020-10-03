<?php

use PHPUnit\Framework\TestCase;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Package\PackageInterface;
use Hexadog\LaravelThemeInstaller\ThemeInstaller;

class ThemeInstallerTest extends TestCase
{
    protected $io;
    protected $composer;
    protected $config;
    protected $test;

    public function setUp(): void
    {
        $this->io = Mockery::mock(IOInterface::class);
        $this->composer = Mockery::mock(Composer::class);
        $this->composer->allows([
            'getPackage' => $this->composer,
            'getDownloadManager' => $this->composer,
            'getConfig' => $this->composer,
            'get' => $this->composer,
        ])->shouldReceive('getExtra')->byDefault();

        $this->test = new ThemeInstaller(
            $this->io, $this->composer
        );
    }

    /**
     * @test
     *
     * Your package composer.json file must include:
     *
     *    "type": "laravel-theme",
     */
    public function it_supports_laravel_theme_type_only()
    {
        $this->assertFalse($this->test->supports('theme'));
        $this->assertTrue($this->test->supports('laravel-theme'));
    }

    /**
     * @test
     */
    public function it_supports_vendor_not_included()
    {
        $mock = $this->getMockPackage('name');

        $this->assertEquals('themes/name', $this->test->getInstallPath($mock));
    }

    /**
     * @test
     */
    public function it_returns_themes_folder_by_default()
    {
        $mock = $this->getMockPackage('vendor/name-theme');
        $this->assertEquals('themes/vendor/name', $this->test->getInstallPath($mock));
    }

    /**
     * @test
     */
    public function it_can_use_compound_theme_names()
    {
        $mock = $this->getMockPackage('vendor/compound-name-theme');

        $this->assertEquals('themes/vendor/compound-name', $this->test->getInstallPath($mock));
    }

    /**
     * @test
     *
     * You can optionally include a base path name
     * in which to install.
     *
     *    "extra": {
     *      "theme-dir": "Custom"
     *    },
     */
    public function it_can_use_custom_path()
    {
        $package = $this->getMockPackage('vendor/name-theme');

        $this->composer->shouldReceive('getExtra')
            ->andReturn(['theme-dir' => 'custom'])
            ->getMock();

        $this->assertEquals('custom/vendor/name', $this->test->getInstallPath($package));
    }


    private function getMockPackage($return)
    {
        return Mockery::mock(PackageInterface::class)
            ->shouldReceive('getPrettyName')
            ->once()
            ->andReturn($return)
            ->getMock();
    }

}
