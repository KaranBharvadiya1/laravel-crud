<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function create(){
        return view('create');
    }
    public function index()
    {
        $products = Product::all();

        return view('index', compact('products'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:250',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:500',
        ]);
        
        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }

    public function destroy(Product $product){
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }

    public function edit(Product $product){
        return view ('edit', compact('product'));
    }

    public function update(Request $request, Product $product){
        $validated = $request->validate([
            'name' => 'required|string|max:250',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:500',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }
}

