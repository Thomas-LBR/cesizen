<?php

namespace Tests\Support;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestTrait;

final class DiagnosticFeatureTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    use FeatureTestTrait;

    protected $namespace = 'App';
    protected $seed = 'App\Database\Seeds\InitialSeeder';

    public function testDiagnosticQuestionnaireDisplaysSeededEvents(): void
    {
        $result = $this->get('/diagnostic');

        $result->assertOK();
        $result->assertSee('Diagnostic de stress');
        $result->assertSee('Divorce');
        $result->assertSee('Calculer mon score');
    }

    public function testAnonymousUserIsRedirectedFromDiagnosticHistory(): void
    {
        $result = $this->get('/diagnostic/resultats');

        $result->assertRedirect();
    }

    public function testConnectedUserCanAccessDiagnosticHistory(): void
    {
        $result = $this
            ->withSession([
                'user_id' => 2,
                'user_name' => 'Thomas Lebrun',
                'role' => 'user',
            ])
            ->get('/diagnostic/resultats');

        $result->assertOK();
        $result->assertSee('Historique des diagnostics');
    }

    public function testAdminCanAccessDiagnosticResultConfiguration(): void
    {
        $result = $this
            ->withSession([
                'user_id' => 1,
                'user_name' => 'Admin CESIZen',
                'role' => 'admin',
            ])
            ->get('/admin/diagnostic/resultats');

        $result->assertOK();
        $result->assertSee('Page de résultat du diagnostic');
        $result->assertSee('Niveau à configurer');
        $result->assertSee('Stress faible');
    }
}
