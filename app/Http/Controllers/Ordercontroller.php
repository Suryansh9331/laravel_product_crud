<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\OrderItem;
use App\Models\Order; // ✅ Corrected Model Name
use App\Models\Orders;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Show My Orders Page
     */
    public function index()
    {
        $orders = Orders::where('user_id', Auth::id())->latest()->get();
        return view('order.index', compact('orders'));
    }

    /**
     * Show Order Summary Before Checkout
     */
    public function orderSummary()
    {
        $cartItems = CartItem::where('user_id', Auth::id())->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $subtotal = 0;
        $validItems = [];

        foreach ($cartItems as $item) {
            if ($item->product && $item->product->quantity >= $item->quantity) {
                $validItems[] = $item;
                $subtotal += $item->quantity * $item->product->price;
            }
        }

        //  Prevents proceeding to order page if no valid items
        if (empty($validItems)) {
            return redirect()->route('cart.index')->with('error', 'No valid items available to place an order.');
        }

        $shipping = 50;
        $total = $subtotal + $shipping;

        return view('order.summary', compact('cartItems', 'subtotal', 'shipping', 'total'));
    }

    /**
     * Place Order (Reduce Stock & Clear Cart)
     */
    public function placeOrder()
    {
        $cartItems = CartItem::where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $subtotal = 0;
        $validItems = [];

        //  Step 1: Validate Stock Before Creating Order
        foreach ($cartItems as $item) {
            $product = Product::find($item->product_id);

            if (!$product || $product->quantity < $item->quantity) {
                continue; // Skip items with insufficient stock
            }

            $validItems[] = $item;
            $subtotal += $item->quantity * $item->product->price;
        }

        //  Step 2: Prevent Empty Order Placement
        if (empty($validItems)) {
            return redirect()->route('cart.index')->with('error', 'No valid items to place an order.');
        }

        $shipping = 50;
        $total = $subtotal + $shipping;

        //  Step 3: Create Order
        $order = new Orders();
        $order->user_id = Auth::id();
        $order->total_price = $total;
        $order->status = 'Pending';
        $order->save();

        //  Step 4: Add Items to Order & Reduce Stock
        foreach ($validItems as $item) {
            $product = Product::find($item->product_id);

            //  Reduce stock
            $product->quantity -= $item->quantity;
            $product->save();

            //  Add item to order_items table
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item->product_id;
            $orderItem->quantity = $item->quantity;
            $orderItem->price = $item->product->price;
            $orderItem->save();
        }

        //  Step 5: Clear the Cart after order placement
        CartItem::where('user_id', Auth::id())->delete();

        return redirect()->route('products.index')->with('success', 'Your order has been placed successfully!');
    }

    
    public function show($id)
    {
        $order = Orders::with('items.product')->where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('order.show', compact('order'));
    }
}
