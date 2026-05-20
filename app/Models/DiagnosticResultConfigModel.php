<?php

namespace App\Models;

use CodeIgniter\Model;

class DiagnosticResultConfigModel extends Model
{
    protected $table = 'diagnostic_result_configs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['level', 'min_score', 'max_score', 'message'];
    protected $useTimestamps = true;
    protected $returnType = 'array';

    public function ordered(): array
    {
        return $this->orderBy('min_score', 'ASC')->findAll();
    }
}
