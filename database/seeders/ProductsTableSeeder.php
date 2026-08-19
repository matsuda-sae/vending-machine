<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'company_id' => 1,
            'product_name' => 'コカ・コーラ 500ml',
            'price' => 160,
            'stock' => 50,
            'comment' => '定番の炭酸飲料です。',
            'img_path' => null,
        ]);

        Product::create([
            'company_id' => 2,
            'product_name' => '天然水 550ml',
            'price' => 120,
            'stock' => 100,
            'comment' => 'すっきり美味しいお水です。',
            'img_path' => null,
        ]);

        Product::create([
            'company_id' => 3,
            'product_name' => 'お〜いお茶 600ml',
            'price' => 140,
            'stock' => 80,
            'comment' => '香り豊かな緑茶です。',
            'img_path' => null,
        ]);
    }
}