<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Customer;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;


class CustomerController extends Controller
{

    public function index(): Response
    {
        $customers =  Customer::select('id','name','email','phone')->get();
        return Inertia::render('Auth/Customer',['customers' => $customers ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Customer::create(
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|max:255',
                'phone' => 'required|string|max:255',
            ])
        );
        sleep(1);
        return redirect()->route('customer.index');
    }

    public function update(Request $request, Customer $customer): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ]);
        
        $customer->update($request->all());
        
        return redirect()->route('customer.index');
    }

    public function destroy(Customer $customer): RedirectResponse
    {
        $customer->delete();
        return redirect()->route('customer.index');    
    }
}
