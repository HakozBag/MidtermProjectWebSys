<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ProductModel;
use App\Models\CustomerModel;
use App\Models\SaleModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $userModel     = new UserModel();
        $productModel  = new ProductModel();
        $customerModel = new CustomerModel();
        $saleModel     = new SaleModel();

        // Calculate totals
        $totalStaff     = $userModel->countAll();
        $totalProducts  = $productModel->countAll();
        $totalCustomers = $customerModel->countAll();
        
        // Calculate total sales revenue & count
        $totalRevenue   = $saleModel->selectSum('total_price')->get()->getRow()->total_price ?? 0;
        $totalTransactions = $saleModel->countAll();

        // Fetch recent sales (with user and customer details if needed)
        $recentSales = $saleModel->orderBy('created_at', 'DESC')->limit(5)->findAll();

        $data = [
            'title'            => 'Dashboard Overview',
            'totalStaff'       => $totalStaff,
            'totalProducts'    => $totalProducts,
            'totalCustomers'   => $totalCustomers,
            'totalRevenue'     => $totalRevenue,
            'totalTransactions'=> $totalTransactions,
            'recentSales'      => $recentSales
        ];

        return view('dashboard', $data);
    }
}