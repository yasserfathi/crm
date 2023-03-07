<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Customer;
use App\Models\Salesman;
use App\Models\Service;
use App\Models\Product;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        $customers =  Customer::get()->count();
        $salesmen =  Salesman::get()->count();
        $services =  Service::get()->count();
        $products =  Product::get()->count();
        return Inertia::render('Auth/Dashboard',['customers' => $customers, 'salesmen' => $salesmen, 'services' => $services, 'products' => $products]);
    }
}
