<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                "product_name" => "ပေါ်ဆန်း(ကြားပျံ)",
                "price" => 1,
                "product_image" => "01-rice.jpg"
            ],
            [
                "product_name" => "မင်္ဂလာ ဆင်းသွယ်",
                "price" => 1,
                "product_image" => "02-rice.jpg"
            ],
            [
                "product_name" => "မင်္ဂလာ ဇီယာ",
                "price" => 1,
                "product_image" => "03-rice.jpg"
            ],
            [
                "product_name" => "မင်္ဂလာ မြေပဲဆီ",
                "price" => 1,
                "product_image" => "04-oil.jpg"
            ],
            [
                "product_name" => "မင်္ဂလာ နေကြာဆီ",
                "price" => 2000,
                "product_image" => "05-oil.jpg"
            ],
            [
                "product_name" => "ကြက်ဥ (၁၀လုံးကတ်)",
                "price" => 1,
                "product_image" => "06-egg.jpg"
            ],
            [
                "product_name" => "ကြက်ဥ (အလုံး၃၀)",
                "price" => 1,
                "product_image" => "07-egg.jpg"
            ],
            [
                "product_name" => "ကြက်ဥ တစ်လုံးချင်း",
                "price" => 1,
                "product_image" => "08-egg.jpg"
            ],
            [
                "product_name" => "သကြား",
                "price" => 1,
                "product_image" => "09-sugar.jpg"
            ],
            [
                "product_name" => "ဆား",
                "price" => 1,
                "product_image" => "10-salt.jpg"
            ],
            [
                "product_name" => "ငါးနီတူခြောက်",
                "price" => 1,
                "product_image" => "11-driedfish.jpg"
            ],
            [
                "product_name" => "၂၄ ပြည်ဆန်ထည့်ပုံး",
                "price" => 500,
                "product_image" => "12-ricebox.jpg"
            ]
        ];

        foreach ($products as $productsData) {
            Products::create($productsData);
        }
    }
}
