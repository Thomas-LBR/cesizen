<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DiagnosticEventModel;

class DiagnosticEvents extends BaseController
{
    public function index()
    {
        return $this->render('admin/diagnostic/index', [
            'title' => 'Questionnaire diagnostic',
            'events' => (new DiagnosticEventModel())->orderBy('points', 'DESC')->findAll(),
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

    public function status(int $id)
    {
        $model = new DiagnosticEventModel();
        $event = $model->find($id);
        $model->update($id, ['is_active' => (int) ! (bool) $event['is_active']]);

        return redirect()->back()->with('success', 'Événement mis à jour.');
    }

    private function save(?int $id = null)
    {
        $model = new DiagnosticEventModel();
        $event = $id ? $model->find($id) : null;

        if ($this->request->getMethod() === 'POST') {
            $data = [
                'label' => trim($this->request->getPost('label')),
                'points' => max(0, (int) $this->request->getPost('points')),
                'is_active' => (int) (bool) $this->request->getPost('is_active'),
            ];

            $id ? $model->update($id, $data) : $model->insert($data);

            return redirect()->to('/admin/diagnostic')->with('success', 'Question enregistrée.');
        }

        return $this->render('admin/diagnostic/form', [
            'title' => $id ? 'Modifier un événement' : 'Ajouter un événement',
            'event' => $event,
        ]);
    }
}
