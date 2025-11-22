<?php

namespace Tests;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Illuminate\Support\Collection;
use Laravel\Dusk\TestCase as BaseTestCase;
use PHPUnit\Framework\Attributes\BeforeClass;

abstract class DuskTestCase extends BaseTestCase
{
    /**
     * Prepare for Dusk test execution.
     */
    #[BeforeClass]
    public static function prepare(): void
    {
        static::startChromeDriver();
    }

    /**
     * Create the RemoteWebDriver instance.
     */
    protected function driver(): RemoteWebDriver
    {
        $options = new ChromeOptions();

        $options->addArguments([
            '--headless',
            '--no-sandbox',
            '--disable-dev-shm-usage',
            '--disable-gpu',
            '--window-size=1920,1080',
        ]);

        return RemoteWebDriver::create(
            env('DUSK_DRIVER_URL', 'http://selenium:4444/wd/hub'),
            DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY,
                $options
            )
        );
    }
}
