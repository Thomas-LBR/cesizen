<?php

namespace App\Services\Diagnostic;

class DiagnosticResult
{
    public function __construct(
        public readonly int $score,
        public readonly string $level,
        public readonly string $message,
    ) {
    }
}
