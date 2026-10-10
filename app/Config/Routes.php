<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Authentication Routes
$routes->get('/', 'Auth::login');
$routes->get('login', 'Auth::login');
$routes->post('login/authenticate', 'Auth::authenticate');
$routes->get('signup', 'Auth::signup');
$routes->post('signup/store', 'Auth::store');
$routes->get('logout', 'Auth::logout');

// Dashboard & Staff
$routes->get('dashboard', 'Dashboard::index');
$routes->get('staff', 'Staff::index');
$routes->post('staff/update/(:num)', 'Staff::update/$1', ['filter' => 'csrf']);
$routes->post('staff/delete/(:num)', 'Staff::delete/$1', ['filter' => 'csrf']);

// Products (Inventory Management)
$routes->get('products', 'Products::index');
$routes->get('products/create', 'Products::create');
$routes->post('products/store', 'Products::store');
$routes->post('products/update/(:num)', 'Products::update/$1');
$routes->get('products/delete/(:num)', 'Products::delete/$1');

// Customers (Customer Management)
$routes->get('customers', 'Customers::index');
$routes->post('customers/store', 'Customers::store');
$routes->post('customers/update/(:num)', 'Customers::update/$1');
$routes->get('customers/delete/(:num)', 'Customers::delete/$1');

// Sales Workflow
$routes->get('sales/record', 'Sales::record');
$routes->post('sales/process', 'Sales::process');
$routes->get('sales/history', 'Sales::history');
