<?php

namespace App\Http\Controllers;

use App\Http\Dao\CartDao;
use App\Http\Services\ProductService;
use App\Http\Services\CartService;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;

class ProductsController extends Controller
{
    private $productService;
    private $cartService;
    private $cartDao;

    public function __construct(ProductService $productService, CartService $cartService, CartDao $cartDao)
    {
        $this->productService = $productService;
        $this->cartService = $cartService;
        $this->cartDao = $cartDao;
    }

    public function index()
    {
        $products = $this->productService->getAllProducts();
        return view('product', ["products" => $products]);
    }

    public function addToCart(Request $request)
    {
        $product = $this->productService->getProductById($request->id);
        $cart = $this->cartService->addProductToCart($product);
        return response()->json(['msg' => 'success', 'cart' => $cart]);
    }

    public function cart()
    {
        $cart = $this->cartService->getCart();
        if (count($cart) > 0) {
            return view('cart', compact('cart'));
        }
        Toastr::info('Your Cart is Empty', 'INFO');
        return back();
    }

    public function updateCart(Request $request)
    {
        $cart = $this->cartService->updateProductQty($request->id, $request->qty);
        $product = $cart[$request->id];
        $sub_total = number_format($product['price'] * $product['qty']);
        return response()->json(['sub_total' => $sub_total]);
    }

    public function destroyCart($id)
    {
        $cart = $this->cartService->removeProductFromCart($id);
        if (count($cart) > 0) {
            Toastr::success('Cart Item Removed Successfully', 'SUCCESS');
            return back();
        }
        return redirect()->route('home');
    }

    public function clear()
    {
        $this->cartService->clearCart();
        return redirect()->route('home');
    }

    public function viewHistory()
    {
        $data = $this->cartDao->viewHistory();
        return view('history', ['data' => $data]);
    }
}
