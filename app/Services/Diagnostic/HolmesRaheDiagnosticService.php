<?php

namespace App\Services\Diagnostic;

class HolmesRaheDiagnosticService
{
    public function calculate(array $events): DiagnosticResult
    {
        $score = 0;

        foreach ($events as $event) {
            $score += (int) ($event['points'] ?? 0);
        }

        return new DiagnosticResult($score, $this->level($score), $this->message($score));
    }

    private function level(int $score): string
    {
        if ($score < 150) {
            return 'Stress faible';
        }

        if ($score < 300) {
            return 'Stress modéré';
        }

        return 'Stress élevé';
    }

    private function message(int $score): string
    {
        if ($score < 150) {
            return 'Votre score indique une exposition limitée aux événements stressants. Continuez à préserver vos temps de repos et vos habitudes protectrices.';
        }

        if ($score < 300) {
            return 'Votre score indique une exposition notable au stress. Il peut être utile d’identifier les sources principales et de mettre en place des pauses régulières.';
        }

        return 'Votre score indique une exposition forte au stress. Ce résultat n’est pas un diagnostic médical, mais il peut justifier d’en parler à un professionnel de santé.';
    }
}
