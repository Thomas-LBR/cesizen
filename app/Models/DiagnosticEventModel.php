<?php

namespace App\Models;

use CodeIgniter\Model;

class DiagnosticEventModel extends Model
{
    protected $table = 'diagnostic_events';
    protected $primaryKey = 'id';
    protected $allowedFields = ['label', 'points', 'is_active'];
    protected $useTimestamps = true;
    protected $returnType = 'array';

    public function active()
    {
        return $this->where('is_active', 1)->orderBy('points', 'DESC');
    }
}
