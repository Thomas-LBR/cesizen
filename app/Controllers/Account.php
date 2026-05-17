<?php

namespace App\Controllers;

use App\Models\UserModel;

class Account extends BaseController
{
    public function profile()
    {
        $model = new UserModel();
        $user = $model->find(session()->get('user_id'));

        if ($this->request->getMethod() === 'POST') {
            $data = [
                'firstname' => trim($this->request->getPost('firstname')),
                'lastname' => trim($this->request->getPost('lastname')),
            ];

            if ($this->request->getPost('password')) {
                $data['password_hash'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            }

            $model->update($user['id'], $data);
            session()->set('user_name', $data['firstname'] . ' ' . $data['lastname']);

            return redirect()->to('/compte')->with('success', 'Profil mis à jour.');
        }

        return $this->render('account/profile', ['title' => 'Mon compte', 'user' => $user]);
    }
}
