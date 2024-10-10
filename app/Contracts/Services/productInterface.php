<?php

namespace App\Contracts\Services;

interface productInterface
{
    public function getAllProducts();
    public function getProductById($id);
}
