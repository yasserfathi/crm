<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Service;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;


class ServiceController extends Controller
{

    public function index(): Response
    {
        $service =  Service::select('id','name')->get();
        return Inertia::render('Auth/Service',['services' => $service ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Service::create(
            $request->validate([
                'name' => 'required|string|max:255',
            ])
        );
        sleep(1);
        return redirect()->route('service.index');
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        
        $service->update($request->all());
        
        return redirect()->route('service.index');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();
        return redirect()->route('service.index');    
    }
}
