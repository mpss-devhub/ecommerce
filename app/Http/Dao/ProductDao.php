<?php

namespace App\Http\Dao;

use App\Contracts\Dao\productDaoInterface;
use App\Models\Products;

class ProductDao implements productDaoInterface
{
    public function getAllProducts()
    {
        $products = Products::get();
        return $products;
    }

    public function getProductById($id)
    {
        $product = Products::find($id);
        return $product;
    }
}
