<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Orders;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{    //login signup controllers
    // Show Admin Login Page
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    // Handle Admin Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            session(['admin_id' => $admin->id, 'admin_name' => $admin->name]); // Admin ka data session  me store karne ke liye
            return redirect()->route('admin.dashboard')->with('success', 'Welcome Admin!');
        }

        return back()->withErrors(['error' => 'Invalid credentials!']);
    }

    // Admin Logout
    public function logout()
    {
        session()->forget(['admin_id', 'admin_name']); //logout ke bad session destroy karne ke liye 
        return redirect()->route('admin.login')->with('success', 'Logged out successfully!');
    }

    //  registration page show karane ke liye (only  one time )
    public function showRegister()
    {
        return view('admin.auth.register');
    }

    //  admin Registration ko handle karega 
     public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6|confirmed',
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password
        ]);

        return redirect()->route('admin.login')->with('success', 'Admin registered successfully!');
    }

    // // Show Admin Dashboard
    // public function dashboard()
    // {
    //     return view('admin.dashboard');
    // }


    public function dashboard()
{
    $users = User::count();
    $products = Product::count();
    $orders = Orders::count();
    $sales = Orders::sum('total_price');

    return view('admin.dashboard', compact('users', 'products', 'orders', 'sales'));
}


    //order  management controller
    // Fetch Orders Data
    public function orders()
    {
        $orders = Orders::with('user', 'products')->get();
        return view('admin.orders.index', compact('orders'));
    }

    // Fetch all users (User Management Page)
    public function users()
    {
        $users = User::all(); // Get all users
        return view('admin.users.index', compact('users'));
    }
    // Delete a user
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully!');
    }



    //product management controllers
    // Fetch all products for admin
    public function products()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    // Show create product form
    public function createProduct()
    {
        return view('admin.products.create');
    }
    // Store a new product
    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $imagePath = $request->file('image')->store('products', 'public');

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.products')->with('success', 'Product added successfully!');
    }

    // Show edit form
    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }
    // Update product details
    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->update($request->only(['name', 'description', 'price', 'discount_price']));
        return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
    }
    // Delete a product
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Product deleted successfully!');
    }
}
