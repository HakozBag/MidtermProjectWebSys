<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Products extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();

        $data = [
            'title'        => 'Product Inventory',
            'productsList' => $productModel->findAll()
        ];

        return view('products/index', $data);
    }

    public function create()
    {
        return view('products/create', [
            'title' => 'Add New Product'
        ]);
    }

    public function store()
    {
        $productModel = new ProductModel();

        $productModel->save([
            'name'           => $this->request->getPost('name'),
            'price'          => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
            'created_at'     => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/products')->with('success', 'Product added successfully!');
    }

    public function update($id)
    {
        $productModel = new ProductModel();

        $productModel->update($id, [
            'name'           => $this->request->getPost('name'),
            'price'          => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity')
        ]);

        return redirect()->to('/products')->with('success', 'Product updated successfully!');
    }

    public function delete($id)
    {
        $productModel = new ProductModel();

        try {
            $productModel->delete($id);
            return redirect()->to('/products')->with('success', 'Product deleted successfully!');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            return redirect()->to('/products')->with('error', 'Cannot delete this product because it has existing sales history records.');
        }
    }
}