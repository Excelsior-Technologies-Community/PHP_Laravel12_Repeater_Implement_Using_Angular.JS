<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with sample products and matrix variants.
     */
    public function run(): void
    {
        ProductVariant::checkAndAddColumns();

        // 1. Classic Cotton Polo T-Shirt
        $p1 = Product::firstOrCreate(
            ['name' => 'Premium Cotton Polo Shirt'],
            ['description' => 'Breathable 100% combed cotton pique fabric with ribbed collar']
        );

        $sizes = ['S', 'M', 'L', 'XL'];
        $colors = ['Navy Blue', 'Classic Black'];

        foreach ($sizes as $s) {
            foreach ($colors as $c) {
                $sku = 'SKU-PRE-' . strtoupper(substr($s, 0, 2)) . '-' . strtoupper(substr($c, 0, 2)) . '-' . rand(100, 999);
                ProductVariant::firstOrCreate(
                    ['product_id' => $p1->id, 'size' => $s, 'color' => $c],
                    [
                        'sku' => $sku,
                        'cost_price' => 280.00,
                        'price' => 599.00,
                        'stock_quantity' => rand(10, 45)
                    ]
                );
            }
        }

        // 2. Slim Fit Denim Jeans
        $p2 = Product::firstOrCreate(
            ['name' => 'Stretchable Denim Jeans'],
            ['description' => 'Modern slim fit denim with stretch comfort and wash finish']
        );

        $pantSizes = ['30', '32', '34'];
        $pantColors = ['Dark Indigo', 'Faded Blue'];

        foreach ($pantSizes as $ps) {
            foreach ($pantColors as $pc) {
                $sku = 'SKU-STR-' . strtoupper(substr($ps, 0, 2)) . '-' . strtoupper(substr($pc, 0, 2)) . '-' . rand(100, 999);
                ProductVariant::firstOrCreate(
                    ['product_id' => $p2->id, 'size' => $ps, 'color' => $pc],
                    [
                        'sku' => $sku,
                        'cost_price' => 550.00,
                        'price' => 1199.00,
                        'stock_quantity' => rand(3, 20)
                    ]
                );
            }
        }
    }
}
