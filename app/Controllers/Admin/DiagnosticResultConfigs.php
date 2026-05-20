<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DiagnosticResultConfigModel;

class DiagnosticResultConfigs extends BaseController
{
    public function index()
    {
        $model = new DiagnosticResultConfigModel();

        if ($this->request->getMethod() === 'POST') {
            foreach ((array) $this->request->getPost('configs') as $id => $config) {
                $model->update((int) $id, [
                    'level' => trim((string) ($config['level'] ?? '')),
                    'min_score' => max(0, (int) ($config['min_score'] ?? 0)),
                    'max_score' => $config['max_score'] === '' ? null : max(0, (int) $config['max_score']),
                    'message' => trim((string) ($config['message'] ?? '')),
                ]);
            }

            return redirect()->to('/admin/diagnostic/resultats')->with('success', 'Page de résultat mise à jour.');
        }

        return $this->render('admin/diagnostic/result_configs', [
            'title' => 'Résultats du diagnostic',
            'configs' => $model->ordered(),
        ]);
    }
}
