<?php

namespace App\Controllers;

use App\Models\PageModel;

class Pages extends BaseController
{
    public function show(string $slug)
    {
        $page = (new PageModel())->published()->where('slug', $slug)->first();

        if (! $page) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->render('pages/show', [
            'title' => $page['title'],
            'page' => $page,
        ]);
    }
}
