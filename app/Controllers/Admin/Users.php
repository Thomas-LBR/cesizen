<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Users extends BaseController
{
    public function index()
    {
        return $this->render('admin/users/index', [
            'title' => 'Utilisateurs',
            'users' => (new UserModel())->orderBy('created_at', 'DESC')->findAll(),
        ]);
    }

    public function role(int $id)
    {
        (new UserModel())->update($id, ['role' => $this->request->getPost('role') === 'admin' ? 'admin' : 'user']);

        return redirect()->back()->with('success', 'Rôle mis à jour.');
    }

    public function status(int $id)
    {
        if ($id === (int) session()->get('user_id')) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas désactiver votre propre compte.');
        }

        $model = new UserModel();
        $user = $model->find($id);
        $model->update($id, ['is_active' => (int) ! (bool) $user['is_active']]);

        return redirect()->back()->with('success', 'Statut mis à jour.');
    }

    public function delete(int $id)
    {
        if ($id === (int) session()->get('user_id')) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        (new UserModel())->delete($id);

        return redirect()->back()->with('success', 'Compte supprimé.');
    }
}
