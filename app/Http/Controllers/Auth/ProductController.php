<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Product;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;


class ProductController extends Controller
{

    public function index(): Response
    {
        $products =  Product::select('id','name')->get();
        return Inertia::render('Auth/Product',['products' => $products ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Product::create(
            $request->validate([
                'name' => 'required|string|max:255',
            ])
        );
        sleep(1);
        return redirect()->route('product.index');
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        
        $product->update($request->all());
        
        return redirect()->route('product.index');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return redirect()->route('product.index');    
    }
}
