<?php

namespace Tests\Support;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestTrait;

final class AuthFeatureTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    use FeatureTestTrait;

    protected $namespace = 'App';
    protected $seed = 'App\Database\Seeds\InitialSeeder';

    public function testLoginPageDisplaysAuthenticationForm(): void
    {
        $result = $this->get('/connexion');

        $result->assertOK();
        $result->assertSee('Connexion');
        $result->assertSee('Email');
        $result->assertSee('Mot de passe');
    }

    public function testAnonymousUserIsRedirectedFromAccountPage(): void
    {
        $result = $this->get('/compte');

        $result->assertRedirect();
    }

    public function testAdminUserCanAccessDashboard(): void
    {
        $result = $this
            ->withSession([
                'user_id' => 1,
                'user_name' => 'Admin CESIZen',
                'role' => 'admin',
            ])
            ->get('/admin');

        $result->assertOK();
        $result->assertSee('Administration');
        $result->assertSee('Utilisateurs');
    }

    public function testRegularUserCannotAccessAdminDashboard(): void
    {
        $result = $this
            ->withSession([
                'user_id' => 2,
                'user_name' => 'Thomas Lebrun',
                'role' => 'user',
            ])
            ->get('/admin');

        $result->assertRedirect();
    }
}
