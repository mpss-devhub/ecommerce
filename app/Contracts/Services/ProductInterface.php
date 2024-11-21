<?php

namespace App\Contracts\Services;

interface ProductInterface
{
    public function getAllProducts();
    public function getProductById($id);
}
