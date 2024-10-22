<?php

namespace App\Http\Controllers;

use App\Http\Dao\CartDao;
use App\Http\Services\ProductService;
use App\Http\Services\CartService;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;

class ProductsController extends Controller
{
    private $ProductService;
    private $CartService;
    private $cartDao;

    public function __construct(ProductService $ProductService, CartService $CartService, CartDao $cartDao)
    {
        $this->ProductService = $ProductService;
        $this->CartService = $CartService;
        $this->cartDao = $cartDao;
    }

    public function index()
    {
        $products = $this->ProductService->getAllProducts();
        return view('product', ["products" => $products]);
    }

    public function addToCart(Request $request)
    {
        $product = $this->ProductService->getProductById($request->id);
        $cart = $this->CartService->addProductToCart($product);
        return response()->json(['msg' => 'success', 'cart' => $cart]);
    }

    public function cart()
    {
        $cart = $this->CartService->getCart();
        if (count($cart) > 0) {
            return view('cart', compact('cart'));
        }
        Toastr::info('Your Cart is Empty', 'INFO');
        return back();
    }

    public function updateCart(Request $request)
    {
        $cart = $this->CartService->updateProductQty($request->id, $request->qty);
        $product = $cart[$request->id];
        $sub_total = number_format($product['price'] * $product['qty']);
        return response()->json(['sub_total' => $sub_total]);
    }

    public function destroyCart($id)
    {
        $cart = $this->CartService->removeProductFromCart($id);
        if (count($cart) > 0) {
            Toastr::success('Cart Item Removed Successfully', 'SUCCESS');
            return back();
        }
        return redirect()->route('home');
    }

    public function clear()
    {
        $this->CartService->clearCart();
        return redirect()->route('home');
    }

    public function viewHistory()
    {
        $data = $this->cartDao->viewHistory();
        return view('history', ['data' => $data]);
    }
}
