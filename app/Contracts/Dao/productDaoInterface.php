<?php

namespace App\Contracts\Dao;

interface productDaoInterface
{
    public function getAllProducts();
    public function getProductById($id);
}
