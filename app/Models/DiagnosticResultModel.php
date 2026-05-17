<?php

namespace App\Models;

use CodeIgniter\Model;

class DiagnosticResultModel extends Model
{
    protected $table = 'diagnostic_results';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'score', 'level', 'message', 'selected_events'];
    protected $useTimestamps = true;
    protected $returnType = 'array';
}
