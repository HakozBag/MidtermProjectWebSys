<?php

namespace App\Controllers;

use App\Models\UserModel;

class Staff extends BaseController
{
    public function index()
    {
        $userId = (int) session()->get('id');
        if (! session()->get('logged_in') || $userId < 1) {
            return redirect()->to(base_url('login'));
        }

        $userModel = new UserModel();

        return view('staff', [
            'title'     => 'Staff Management',
            'staffList' => $userModel->orderBy('id', 'ASC')->findAll(),
            'currentUserId' => $userId,
        ]);
    }

    public function update(int $id)
    {
        $currentUserId = (int) session()->get('id');
        if (! session()->get('logged_in') || $currentUserId < 1) {
            return redirect()->to(base_url('login'));
        }

        $userModel = new UserModel();
        if ($userModel->find($id) === null) {
            return redirect()->to(base_url('staff'))->with('error', 'Staff account not found.');
        }

        $input = [
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'email'     => trim((string) $this->request->getPost('email')),
            'username'  => trim((string) $this->request->getPost('username')),
        ];

        $validation = service('validation');
        $validation->setRules([
            'full_name' => 'required|min_length[3]|max_length[100]',
            'email'     => 'required|valid_email|max_length[254]',
            'username'  => 'required|min_length[3]|max_length[50]',
        ]);

        if (! $validation->run($input)) {
            return redirect()->to(base_url('staff'))
                ->with('error', implode(' ', $validation->getErrors()));
        }

        $existingEmail = $userModel->where('email', $input['email'])->first();
        if ($existingEmail !== null && (int) $existingEmail['id'] !== $id) {
            return redirect()->to(base_url('staff'))->with('error', 'That email is already used by another staff account.');
        }

        $existingUsername = $userModel->where('username', $input['username'])->first();
        if ($existingUsername !== null && (int) $existingUsername['id'] !== $id) {
            return redirect()->to(base_url('staff'))->with('error', 'That username is already used by another staff account.');
        }

        try {
            if (! $userModel->update($id, $input)) {
                return redirect()->to(base_url('staff'))->with('error', 'Could not update the staff account.');
            }
        } catch (\Throwable $e) {
            log_message('error', 'Staff update failed: ' . $e->getMessage());
            return redirect()->to(base_url('staff'))->with('error', 'Could not update the staff account.');
        }

        if ($id === $currentUserId) {
            session()->set([
                'full_name' => $input['full_name'],
                'username'  => $input['username'],
            ]);
        }

        return redirect()->to(base_url('staff'))->with('success', 'Staff account updated.');
    }

    public function delete(int $id)
    {
        $currentUserId = (int) session()->get('id');
        if (! session()->get('logged_in') || $currentUserId < 1) {
            return redirect()->to(base_url('login'));
        }

        if ($id === $currentUserId) {
            return redirect()->to(base_url('staff'))->with('error', 'You cannot delete your own account.');
        }

        $userModel = new UserModel();
        if ($userModel->find($id) === null) {
            return redirect()->to(base_url('staff'))->with('error', 'Staff account not found.');
        }

        if ($userModel->countAllResults() <= 1) {
            return redirect()->to(base_url('staff'))->with('error', 'The last staff account cannot be deleted.');
        }

        try {
            if (! $userModel->delete($id)) {
                return redirect()->to(base_url('staff'))->with('error', 'Could not delete the staff account.');
            }
        } catch (\Throwable $e) {
            log_message('error', 'Staff delete failed: ' . $e->getMessage());
            return redirect()->to(base_url('staff'))->with('error', 'Could not delete the staff account.');
        }

        return redirect()->to(base_url('staff'))->with('success', 'Staff account deleted.');
    }
}
