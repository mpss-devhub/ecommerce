<?php

namespace App\Contracts\Dao;

interface ProductDaoInterface
{
    public function getAllProducts();
    public function getProductById($id);
}
