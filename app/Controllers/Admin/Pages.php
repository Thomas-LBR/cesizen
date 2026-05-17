<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PageModel;

class Pages extends BaseController
{
    public function index()
    {
        return $this->render('admin/pages/index', [
            'title' => 'Pages d’information',
            'pages' => (new PageModel())->orderBy('updated_at', 'DESC')->findAll(),
        ]);
    }

    public function create()
    {
        return $this->save();
    }

    public function edit(int $id)
    {
        return $this->save($id);
    }

    public function delete(int $id)
    {
        (new PageModel())->delete($id);

        return redirect()->back()->with('success', 'Page supprimée.');
    }

    private function save(?int $id = null)
    {
        $model = new PageModel();
        $page = $id ? $model->find($id) : null;

        if ($this->request->getMethod() === 'POST') {
            $slug = url_title($this->request->getPost('title'), '-', true);
            $data = [
                'title' => trim($this->request->getPost('title')),
                'slug' => $slug,
                'summary' => trim($this->request->getPost('summary')),
                'content' => trim($this->request->getPost('content')),
                'is_published' => (int) (bool) $this->request->getPost('is_published'),
            ];

            $id ? $model->update($id, $data) : $model->insert($data);

            return redirect()->to('/admin/pages')->with('success', 'Page enregistrée.');
        }

        return $this->render('admin/pages/form', [
            'title' => $id ? 'Modifier une page' : 'Créer une page',
            'page' => $page,
        ]);
    }
}
