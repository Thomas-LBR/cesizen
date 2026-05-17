<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function register()
    {
        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'firstname' => 'required|min_length[2]|max_length[80]',
                'lastname' => 'required|min_length[2]|max_length[80]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[8]',
                'password_confirm' => 'matches[password]',
            ];

            if ($this->validate($rules)) {
                (new UserModel())->insert([
                    'firstname' => trim($this->request->getPost('firstname')),
                    'lastname' => trim($this->request->getPost('lastname')),
                    'email' => strtolower(trim($this->request->getPost('email'))),
                    'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'role' => 'user',
                    'is_active' => 1,
                ]);

                return redirect()->to('/connexion')->with('success', 'Compte créé, vous pouvez vous connecter.');
            }
        }

        return $this->render('auth/register', ['title' => 'Inscription']);
    }

    public function login()
    {
        if ($this->request->getMethod() === 'POST') {
            $user = (new UserModel())->where('email', strtolower(trim($this->request->getPost('email'))))->first();

            if ($user && (int) $user['is_active'] === 1 && password_verify($this->request->getPost('password'), $user['password_hash'])) {
                session()->regenerate();
                session()->set([
                    'user_id' => $user['id'],
                    'user_name' => $user['firstname'] . ' ' . $user['lastname'],
                    'role' => $user['role'],
                ]);

                return redirect()->to($user['role'] === 'admin' ? '/admin' : '/');
            }

            return redirect()->back()->withInput()->with('error', 'Identifiants invalides ou compte désactivé.');
        }

        return $this->render('auth/login', ['title' => 'Connexion']);
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/')->with('success', 'Vous êtes déconnecté.');
    }

    public function forgotPassword()
    {
        $token = null;

        if ($this->request->getMethod() === 'POST') {
            $model = new UserModel();
            $user = $model->where('email', strtolower(trim($this->request->getPost('email'))))->first();

            if ($user) {
                $token = bin2hex(random_bytes(24));
                $model->update($user['id'], [
                    'reset_token' => password_hash($token, PASSWORD_DEFAULT),
                    'reset_expires_at' => date('Y-m-d H:i:s', strtotime('+1 hour')),
                ]);
            }

            session()->setFlashdata('success', 'Si le compte existe, une demande de réinitialisation a été créée.');
        }

        return $this->render('auth/forgot', ['title' => 'Mot de passe oublié', 'token' => $token]);
    }

    public function resetPassword()
    {
        if ($this->request->getMethod() === 'POST') {
            $model = new UserModel();
            $email = strtolower(trim($this->request->getPost('email')));
            $token = trim($this->request->getPost('token'));
            $user = $model->where('email', $email)->first();

            if (
                $user
                && $user['reset_token']
                && strtotime($user['reset_expires_at']) > time()
                && password_verify($token, $user['reset_token'])
                && strlen((string) $this->request->getPost('password')) >= 8
            ) {
                $model->update($user['id'], [
                    'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'reset_token' => null,
                    'reset_expires_at' => null,
                ]);

                return redirect()->to('/connexion')->with('success', 'Mot de passe mis à jour.');
            }

            return redirect()->back()->withInput()->with('error', 'Demande de réinitialisation invalide.');
        }

        return $this->render('auth/reset', ['title' => 'Réinitialiser le mot de passe']);
    }
}
