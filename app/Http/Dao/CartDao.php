<?php

namespace App\Http\Dao;

use App\Contracts\Dao\cartDaoInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartDao implements cartDaoInterface
{

    public function saveCartInDb($productData, $invoiceNo)
    {
        foreach ($productData as $item) {
            DB::table('carts')->insert([
                'product_id' => $item['product']['id'],
                'quantity' => $item['qty'],
                'invoice_no' => $invoiceNo,
                'created_user_id' => Auth::id(),
                'check_out_flg' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function viewHistory()
    {
        $history = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->join('users', 'carts.created_user_id', '=', 'users.id')
            ->select(
                'carts.invoice_no',
                'users.name',
                DB::raw('GROUP_CONCAT(products.product_name) as product_names'),
                DB::raw('GROUP_CONCAT(products.product_image) as product_images'),
                DB::raw('SUM(products.price * carts.quantity) as total_amount'), // Sum of product prices multiplied by quantity
                DB::raw('GROUP_CONCAT(carts.quantity) as quantities'),
                'carts.created_at'
            )
            ->groupBy('carts.invoice_no', 'users.name', 'carts.created_at')
            ->get();
        return $history;
    }
}
