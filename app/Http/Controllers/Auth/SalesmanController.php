<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Salesman;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;


class SalesmanController extends Controller
{

    public function index(): Response
    {
        $salesmen =  Salesman::select('id','name','email','phone')->get();
        return Inertia::render('Auth/Salesman',['salesmen' => $salesmen ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Salesman::create(
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|max:255',
                'phone' => 'required|string|max:255',
            ])
        );
        sleep(1);
        return redirect()->route('salesman.index');
    }

    public function update(Request $request, Salesman $salesman): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ]);
        
        $salesman->update($request->all());
        
        return redirect()->route('salesman.index');
    }

    public function destroy(Salesman $salesman): RedirectResponse
    {
        $salesman->delete();
        return redirect()->route('salesman.index');    
    }
}