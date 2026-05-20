<?php

namespace Tests\Support;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

final class PwaRegressionTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    protected $migrate = false;

    public function testMainLayoutExposesPwaAssets(): void
    {
        $result = $this->get('/connexion');

        $result->assertOK();
        $result->assertSee('manifest.webmanifest');
        $result->assertSee('service-worker.js');
        $result->assertSee('theme-color');
    }

    public function testManifestIsAvailable(): void
    {
        $manifest = json_decode((string) file_get_contents(PUBLICPATH . 'manifest.webmanifest'), true);

        $this->assertSame('CESIZen', $manifest['name']);
        $this->assertSame('standalone', $manifest['display']);
        $this->assertSame('/', $manifest['start_url']);
    }

    public function testLoginFormHasExplicitActionForMobileBrowsers(): void
    {
        $result = $this->get('/connexion');

        $result->assertOK();
        $result->assertSee('method="post"');
        $result->assertSee('/connexion');
    }
}
