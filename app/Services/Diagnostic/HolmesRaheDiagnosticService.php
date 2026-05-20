<?php

namespace App\Services\Diagnostic;

class HolmesRaheDiagnosticService
{
    public function calculate(array $events, ?array $resultConfigs = null): DiagnosticResult
    {
        $score = 0;

        foreach ($events as $event) {
            $score += (int) ($event['points'] ?? 0);
        }

        $config = $this->matchingConfig($score, $resultConfigs ?? $this->defaultConfigs());

        return new DiagnosticResult($score, $config['level'], $config['message']);
    }

    private function matchingConfig(int $score, array $configs): array
    {
        foreach ($configs as $config) {
            $min = (int) ($config['min_score'] ?? 0);
            $max = $config['max_score'] ?? null;

            if ($score >= $min && ($max === null || $max === '' || $score <= (int) $max)) {
                return [
                    'level' => (string) $config['level'],
                    'message' => (string) $config['message'],
                ];
            }
        }

        return [
            'level' => 'Résultat indisponible',
            'message' => 'Aucune configuration ne correspond à ce score. Veuillez contacter un administrateur.',
        ];
    }

    private function defaultConfigs(): array
    {
        return [
            [
                'level' => 'Stress faible',
                'min_score' => 0,
                'max_score' => 149,
                'message' => 'Votre score indique une exposition limitée aux événements stressants. Continuez à préserver vos temps de repos et vos habitudes protectrices.',
            ],
            [
                'level' => 'Stress modéré',
                'min_score' => 150,
                'max_score' => 299,
                'message' => 'Votre score indique une exposition notable au stress. Il peut être utile d’identifier les sources principales et de mettre en place des pauses régulières.',
            ],
            [
                'level' => 'Stress élevé',
                'min_score' => 300,
                'max_score' => null,
                'message' => 'Votre score indique une exposition forte au stress. Ce résultat n’est pas un diagnostic médical, mais il peut justifier d’en parler à un professionnel de santé.',
            ],
        ];
    }
}
