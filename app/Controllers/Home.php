<?php

namespace App\Controllers;

use App\Models\PageModel;

class Home extends BaseController
{
    public function index()
    {
        $pages = (new PageModel())->published()->findAll(3);

        return $this->render('home/index', [
            'title' => 'CESIZen',
            'pages' => $pages,
        ]);
    }
}
