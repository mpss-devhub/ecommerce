<?php

namespace App\Contracts\Dao;

interface cartDaoInterface
{
    public function saveCartInDb($productId, $quantity);
}
