<?php

namespace App\Contracts\Services;

interface cartInterface
{
    public function getCart();
    public function saveCart($cart);
    public function addProductToCart($product);
    public function updateProductQty($id, $qty);
    public function removeProductFromCart($id);
    public function clearCart();
}
