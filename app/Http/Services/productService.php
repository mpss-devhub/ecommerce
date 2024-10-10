<?php

namespace App\Http\Services;

use App\Contracts\Services\productInterface;
use App\Http\Dao\ProductDao;

class productService implements productInterface
{
    private $productDao;

    public function __construct(ProductDao $productDao)
    {
        $this->productDao = $productDao;
    }

    public function getAllProducts()
    {
        return $this->productDao->getAllProducts();
    }

    public function getProductById($id)
    {
        return $this->productDao->getProductById($id);
    }
}
