<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function authenticate()
    {
        $session = session();
        $model = new UserModel();

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $user = $model->where('username', $username)->first();

        if ($user) {
            // Verify password hash
            if (password_verify($password, $user['password'])) {
                $sesData = [
                    'id'        => $user['id'],
                    'username'  => $user['username'],
                    'full_name' => $user['full_name'],
                    'logged_in' => TRUE
                ];
                $session->set($sesData);
                return redirect()->to('/dashboard');
            } else {
                $session->setFlashdata('error', 'Invalid Password');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('error', 'Username not found');
            return redirect()->to('/login');
        }
    }

    public function signup()
    {
        return view('auth/signup');
    }

    public function store()
    {
        // Validation rules
        $rules = [
            'full_name' => 'required|min_length[3]|max_length[100]',
            'email'     => 'required|valid_email|is_unique[users.email]',
            'username'  => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
            'password'  => 'required|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            $data['validation'] = $this->validator;
            return view('auth/signup', $data);
        }

        $model = new UserModel();

        // Handle avatar file upload if provided
        $avatarName = null;
        $avatarFile = $this->request->getFile('avatar');
        if ($avatarFile && $avatarFile->isValid() && !$avatarFile->hasMoved()) {
            $avatarName = $avatarFile->getRandomName();
            $avatarFile->move(FCPATH . 'uploads/avatars', $avatarName);
        }

        $model->save([
            'full_name'  => $this->request->getVar('full_name'),
            'email'      => $this->request->getVar('email'),
            'username'   => $this->request->getVar('username'),
            'password'   => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT), // Hash
            'avatar'     => $avatarName,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        session()->setFlashdata('success', 'Registration successful! Please login.');
        return redirect()->to('/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}