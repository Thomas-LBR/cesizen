<?php

namespace App\Models;

use CodeIgniter\Model;

class PageModel extends Model
{
    protected $table = 'pages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'slug', 'summary', 'content', 'is_published'];
    protected $useTimestamps = true;
    protected $returnType = 'array';

    public function published()
    {
        return $this->where('is_published', 1)->orderBy('title', 'ASC');
    }
}
