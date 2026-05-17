<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DiagnosticEventModel;
use App\Models\DiagnosticResultModel;
use App\Models\PageModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function index()
    {
        return $this->render('admin/dashboard', [
            'title' => 'Administration',
            'stats' => [
                'users' => (new UserModel())->countAllResults(),
                'pages' => (new PageModel())->countAllResults(),
                'events' => (new DiagnosticEventModel())->countAllResults(),
                'results' => (new DiagnosticResultModel())->countAllResults(),
            ],
        ]);
    }
}
