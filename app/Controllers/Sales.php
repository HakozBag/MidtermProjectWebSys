<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CustomerModel;
use App\Models\SaleModel;

class Sales extends BaseController
{
    public function record()
    {
        $productModel  = new ProductModel();
        $customerModel = new CustomerModel();

        $data = [
            'title'     => 'Record Sale',
            'products'  => $productModel->where('stock_quantity >', 0)->findAll(),
            'customers' => $customerModel->findAll()
        ];

        return view('sales/record', $data);
    }

    public function process()
    {
        $saleModel    = new SaleModel();
        $productModel = new ProductModel();

        $customerId  = $this->request->getPost('customer_id');
        $productId   = $this->request->getPost('product_id');
        $quantity    = (int) $this->request->getPost('quantity');
        
        $soldBy      = session()->get('user_id') ?? 1;

        $product = $productModel->find($productId);

        if (!$product || $product['stock_quantity'] < $quantity) {
            return redirect()->back()->with('error', 'Insufficient stock or invalid product selected.');
        }

        $totalPrice = $product['price'] * $quantity;

        // Save with both column variations to prevent missing value columns in the database
        $saleModel->save([
            'customer_id'  => $customerId ?: null,
            'product_id'   => $productId,
            'quantity'     => $quantity,
            'total_amount' => $totalPrice,
            'total_price'  => $totalPrice,
            'sold_by'      => $soldBy,
            'created_at'   => date('Y-m-d H:i:s')
        ]);

        $productModel->update($productId, [
            'stock_quantity' => $product['stock_quantity'] - $quantity
        ]);

        return redirect()->to('/sales/history')->with('success', 'Sale recorded successfully!');
    }

    public function history()
    {
        $saleModel = new SaleModel();

        $salesList = $saleModel->select('sales.*, products.name as product_name, customers.full_name as customer_name')
            ->join('products', 'products.id = sales.product_id', 'left')
            ->join('customers', 'customers.id = sales.customer_id', 'left')
            ->orderBy('sales.created_at', 'DESC')
            ->findAll();

        foreach ($salesList as &$sale) {
            if (empty($sale['total_amount']) && !empty($sale['total_price'])) {
                $sale['total_amount'] = $sale['total_price'];
            }
            if (empty($sale['total_price']) && !empty($sale['total_amount'])) {
                $sale['total_price'] = $sale['total_amount'];
            }
        }

        $data = [
            'title'     => 'Sales History',
            'salesList' => $salesList
        ];

        return view('sales/history', $data);
    }
}