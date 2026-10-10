<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class Customers extends BaseController
{
    public function index()
    {
        $customerModel = new CustomerModel();

        $data = [
            'title'         => 'Customer Management',
            'customersList' => $customerModel->findAll()
        ];

        return view('customers/index', $data);
    }

    public function create()
    {
        return view('customers/create', [
            'title' => 'Add New Customer'
        ]);
    }

    public function store()
    {
        $customerModel = new CustomerModel();

        $rules = [
            'full_name' => 'required|min_length[2]|max_length[100]',
            'email'     => 'required|valid_email',
            'phone'     => 'required|min_length[7]|max_length[20]',
        ];

        if (!$this->validate($rules)) {
            return view('customers/create', [
                'title'      => 'Add New Customer',
                'validation' => $this->validator
            ]);
        }

        $customerModel->save([
            'full_name'  => $this->request->getVar('full_name'),
            'email'      => $this->request->getVar('email'),
            'phone'      => $this->request->getVar('phone'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/customers')->with('success', 'Customer added successfully!');
    }

    public function update($id)
    {
        $customerModel = new CustomerModel();

        $customerModel->update($id, [
            'full_name' => $this->request->getVar('full_name'),
            'email'     => $this->request->getVar('email'),
            'phone'     => $this->request->getVar('phone')
        ]);

        return redirect()->to('/customers')->with('success', 'Customer updated successfully!');
    }

    public function delete($id)
    {
        $customerModel = new CustomerModel();

        try {
            $customerModel->delete($id);
            return redirect()->to('/customers')->with('success', 'Customer deleted successfully!');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            return redirect()->to('/customers')->with('error', 'Cannot delete this customer because they have existing sales records.');
        }
    }
}