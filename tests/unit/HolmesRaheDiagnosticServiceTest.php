<?php

namespace Tests\Support;

use App\Services\Diagnostic\HolmesRaheDiagnosticService;
use CodeIgniter\Test\CIUnitTestCase;

class HolmesRaheDiagnosticServiceTest extends CIUnitTestCase
{
    public function testItReturnsLowStressUnder150Points(): void
    {
        $result = (new HolmesRaheDiagnosticService())->calculate([
            ['points' => 40],
            ['points' => 30],
        ]);

        $this->assertSame(70, $result->score);
        $this->assertSame('Stress faible', $result->level);
    }

    public function testItReturnsModerateStressBetween150And299Points(): void
    {
        $result = (new HolmesRaheDiagnosticService())->calculate([
            ['points' => 100],
            ['points' => 73],
        ]);

        $this->assertSame(173, $result->score);
        $this->assertSame('Stress modéré', $result->level);
    }

    public function testItReturnsHighStressFrom300Points(): void
    {
        $result = (new HolmesRaheDiagnosticService())->calculate([
            ['points' => 100],
            ['points' => 73],
            ['points' => 65],
            ['points' => 63],
        ]);

        $this->assertSame(301, $result->score);
        $this->assertSame('Stress élevé', $result->level);
    }
    public function testItUsesCustomResultConfiguration(): void
    {
        $result = (new HolmesRaheDiagnosticService())->calculate(
            [
                ['points' => 60],
                ['points' => 50],
            ],
            [
                [
                    'level' => 'Niveau custom',
                    'min_score' => 0,
                    'max_score' => 120,
                    'message' => 'Message administrable.',
                ],
            ]
        );

        $this->assertSame(110, $result->score);
        $this->assertSame('Niveau custom', $result->level);
        $this->assertSame('Message administrable.', $result->message);
    }
}
