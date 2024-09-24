<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Products::get();
        return view('product', compact('products'));
    }

    public function addToCart(Request $request)
    {
        $product = Products::find($request->id);
        $cart = session()->get('cart');
        if (isset($cart[$request->id])) {
            return response()->json(['msg' => 'error', 'cart' => $cart]);
        }
        $cart[$request->id] = $product->toArray();
        $cart[$request->id]['price'] = $product->price;
        $cart[$request->id]['qty'] = 1;
        session()->put('cart', $cart);
        return response()->json(['msg' => 'success', 'cart' => $cart]);
    }

    public function cart()
    {
        $cart = session()->get('cart');
        return view('cart', compact('cart'));
    }

    public function updateCart(Request $request)
    {
        $data = $request->all();
        $cart = session()->get('cart');
        $cart[$data['id']]['qty'] = $data['qty'];
        $tt_price  = $cart[$data['id']]['price'] * $data['qty'];
        $sub_total = number_format($tt_price);
        session()->put('cart', $cart);
        return response()->json(['sub_total' => $sub_total]);
    }

    public function destroyCart($id)
    {
        $cart = session()->get('cart');
        unset($cart[$id]);
        session()->put('cart', $cart);
        $result = count(session()->get('cart')) > 0 ? $status = true : $status = false;
        if ($result) {
            Toastr::success('Cart Item Removed Successfully', 'SUCCESS');
            return back();
        }
        return redirect()->route('home');
    }

    function clear()
    {
        session()->forget('cart');
        return redirect()->route('home');
    }
}
