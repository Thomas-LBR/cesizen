<?php

namespace Tests\Support;

use App\Models\DiagnosticResultConfigModel;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;

final class DiagnosticResultConfigModelTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    protected $namespace = 'App';

    public function testOrderedReturnsConfigurationsByMinimumScore(): void
    {
        $this->db->table('diagnostic_result_configs')->emptyTable();

        $model = new DiagnosticResultConfigModel();
        $model->insertBatch([
            [
                'level' => 'Élevé',
                'min_score' => 300,
                'max_score' => null,
                'message' => 'Message élevé',
            ],
            [
                'level' => 'Faible',
                'min_score' => 0,
                'max_score' => 149,
                'message' => 'Message faible',
            ],
            [
                'level' => 'Modéré',
                'min_score' => 150,
                'max_score' => 299,
                'message' => 'Message modéré',
            ],
        ]);

        $levels = array_column($model->ordered(), 'level');

        $this->assertSame(['Faible', 'Modéré', 'Élevé'], $levels);
    }
}
