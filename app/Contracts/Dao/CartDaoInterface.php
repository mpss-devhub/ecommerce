<?php

namespace App\Contracts\Dao;

interface CartDaoInterface
{
    public function saveCartInDb($productId, $quantity);
}
