<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Display all products
    public function index()
    {   $products = Product::paginate(8); 
        // $products = Product::all();
        return view('products.index', compact('products'));             
    }

    // Show create product form
    public function create()
    {
        return view('products.create');
    }

    // Store new product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = 'assets/' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('assets'), $imagePath);
        }

        // Creating new Product object
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->discount_price = $request->discount_price;
        $product->image = $imagePath;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product added successfully');
    }

    // Show edit product form
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    // Update product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            $imagePath = 'assets/' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('assets'), $imagePath);
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->discount_price = $request->discount_price;
        $product->image = $imagePath;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    // Delete product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
         return view('products.show' , compact('product'))  ; 
       }
}