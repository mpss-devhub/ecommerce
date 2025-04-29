<?php

namespace App\Http\Dao;

use App\Contracts\Dao\CartDaoInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartDao implements CartDaoInterface
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
        $userId = Auth::id();
        $history = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->join('users', 'carts.created_user_id', '=', 'users.id')
            ->select(
                'carts.invoice_no',
                'carts.check_out_flg',
                'users.name',
                DB::raw('GROUP_CONCAT(products.product_name) as product_names'),
                DB::raw('GROUP_CONCAT(products.product_image) as product_images'),
                DB::raw('GROUP_CONCAT(products.price) as prices'),
                DB::raw('SUM(products.price * carts.quantity) as total_amount'),
                DB::raw('GROUP_CONCAT(carts.quantity) as quantities'),
                'carts.created_at'
            )
            // ->where('carts.check_out_flg', 'SUCCESS')
            ->where('carts.created_user_id', $userId)
            ->groupBy('carts.invoice_no', 'users.name', 'carts.created_at', 'carts.check_out_flg')
            ->get();

        return $history;
    }
}
