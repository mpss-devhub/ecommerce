<?php

namespace App\Http\Services;

use App\Contracts\Services\CartInterface;

class CartService implements CartInterface
{
    public function getCart()
    {
        return session()->get('cart', []);
    }

    public function saveCart($cart)
    {
        session()->put('cart', $cart);
    }

    public function addProductToCart($product)
    {
        $cart = $this->getCart();
        if (!isset($cart[$product->id])) {
            $cart[$product->id] = [
                'product' => $product->toArray(),
                'price' => $product->price,
                'qty' => 1
            ];
        }
        $this->saveCart($cart);
        return $cart;
    }

    public function updateProductQty($id, $qty)
    {
        $cart = $this->getCart();
        if (isset($cart[$id])) {
            $cart[$id]['qty'] = $qty;
            $this->saveCart($cart);
        }
        return $cart;
    }

    public function removeProductFromCart($id)
    {
        $cart = $this->getCart();
        unset($cart[$id]);
        $this->saveCart($cart);
        return $cart;
    }

    public function clearCart()
    {
        session()->forget('cart');
    }

}
