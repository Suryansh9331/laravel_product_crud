<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Show all cart items for the logged-in user
    public function index()
    {
        $cartItems = CartItem::where('user_id', Auth::id())->with('product')->get();
        return view('cart.index', compact('cartItems'));
    }

    public function addToCart(Request $request)
{
    $product = Product::findOrFail($request->product_id);

    // Check if product is already in cart
    $cartItem = CartItem::where('user_id', Auth::id())
                        ->where('product_id', $product->id)
                        ->first();

    if ($cartItem) {
        $cartItem->quantity += 1;
        $cartItem->save();
    } else {
        // Create a new cart entry
        $cartItem = new CartItem();
        $cartItem->user_id = Auth::id();
        $cartItem->product_id = $product->id;
        $cartItem->price = $product->price; 
        $cartItem->save();
    }

    return redirect()->back()->with('success', 'Product added to cart successfully!');
}



public function updateCart(Request $request)
{
    // Validate input
    $request->validate([
        'cart_item_id' => 'required|exists:cart_items,id',
        'quantity' => 'required|integer|min:1'
    ]);

    // Find the specific cart item
    $cartItem = CartItem::where('id', $request->cart_item_id)
                        ->where('user_id', Auth::id())
                        ->first();

    if ($cartItem) {
        if($request['type'] == 'increament'){
            $cartItem->quantity += $request->quantity;

        }else {
            $cartItem->quantity -= $request->quantity;

        }
        $cartItem->save();
    }

    return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
}


    // Remove an item from the cart
    public function removeFromCart($id)
    {
        $cartItem = CartItem::findOrFail($id);
        if ($cartItem->user_id !== Auth::id()) {
            return redirect()->route('cart.index')->with('error', 'Unauthorized action!');
        }

        $cartItem->delete();
        return redirect()->route('cart.index')->with('success', 'Item removed from cart!');
    }
}
