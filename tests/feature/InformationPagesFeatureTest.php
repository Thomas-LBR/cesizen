<?php

namespace Tests\Support;

use App\Models\PageModel;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestTrait;

final class InformationPagesFeatureTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    use FeatureTestTrait;

    protected $namespace = 'App';
    protected $seed = 'App\Database\Seeds\InitialSeeder';

    public function testHomePageDisplaysPublishedInformationPages(): void
    {
        $result = $this->get('/');

        $result->assertOK();
        $result->assertSee('Informations utiles');
        $result->assertSee('Comprendre le stress');
        $result->assertSee('Prévenir la surcharge mentale');
    }

    public function testPublishedInformationPageCanBeConsulted(): void
    {
        $result = $this->get('/page/comprendre-le-stress');

        $result->assertOK();
        $result->assertSee('Comprendre le stress');
        $result->assertSee('Le stress est une réaction naturelle');
    }

    public function testPublishedScopeDoesNotReturnDraftPages(): void
    {
        $model = new PageModel();
        $model->insert([
            'title' => 'Page brouillon',
            'slug' => 'page-brouillon',
            'summary' => 'Résumé non publié.',
            'content' => 'Contenu non publié.',
            'is_published' => 0,
        ]);

        $publishedSlugs = array_column($model->published()->findAll(), 'slug');

        $this->assertNotContains('page-brouillon', $publishedSlugs);
    }
}
