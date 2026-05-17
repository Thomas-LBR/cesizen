<?php

namespace App\Controllers;

use App\Models\DiagnosticEventModel;
use App\Models\DiagnosticResultModel;
use App\Services\Diagnostic\HolmesRaheDiagnosticService;

class Diagnostic extends BaseController
{
    public function index()
    {
        return $this->render('diagnostic/index', [
            'title' => 'Diagnostic de stress',
            'events' => (new DiagnosticEventModel())->active()->findAll(),
        ]);
    }

    public function calculate()
    {
        $ids = array_map('intval', (array) $this->request->getPost('events'));
        $eventModel = new DiagnosticEventModel();
        $events = $ids ? $eventModel->whereIn('id', $ids)->where('is_active', 1)->findAll() : [];
        $result = (new HolmesRaheDiagnosticService())->calculate($events);

        if (session()->get('user_id')) {
            (new DiagnosticResultModel())->insert([
                'user_id' => session()->get('user_id'),
                'score' => $result->score,
                'level' => $result->level,
                'message' => $result->message,
                'selected_events' => json_encode(array_column($events, 'label'), JSON_UNESCAPED_UNICODE),
            ]);
        }

        return $this->render('diagnostic/result', [
            'title' => 'Résultat du diagnostic',
            'result' => $result,
            'events' => $events,
            'isSaved' => (bool) session()->get('user_id'),
        ]);
    }

    public function history()
    {
        $results = (new DiagnosticResultModel())
            ->where('user_id', session()->get('user_id'))
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return $this->render('diagnostic/history', [
            'title' => 'Historique des diagnostics',
            'results' => $results,
        ]);
    }
}
