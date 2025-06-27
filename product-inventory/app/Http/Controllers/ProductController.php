<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use Illuminate\Support\Facades\Log;
use App\Notifications\ProductEventNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\User;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        \Log::info('Index function called with filters:', $request->all());
        $query = Product::query();

        // Filter by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->get();

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|string|max:255',
        ]);
    
        $product = Product::create($request->all());

        // Notify all users (or filter as needed)
        foreach (User::all() as $user) {
            $user->notify(new ProductEventNotification("A new product '{$product->name}' was created!"));
        }

        return redirect()->route('products.index')->with('success', 'Product created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $product = Product::findOrFail($id);

        $product->update($request->all());

        // Notify all users
        foreach (User::all() as $user) {
            $user->notify(new ProductEventNotification("Product '{$product->name}' was updated!"));
        }

        return redirect()->route('products.index')->with('success', 'Product updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        // Notify all users
        foreach (User::all() as $user) {
            $user->notify(new ProductEventNotification("Product '{$product->name}' was deleted!"));
        }

        return redirect()->route('products.index')->with('success', 'Product soft-deleted!');
    }


    public function trashed()
    {
        $products = Product::onlyTrashed()->get();
        return view('products.trashed', compact('products'));
    }

    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();

        // Notify all users
        foreach (User::all() as $user) {
            $user->notify(new ProductEventNotification("Product '{$product->name}' was restored!"));
        }

        return redirect()->route('products.index')->with('success', 'Product restored!');
    }

}
