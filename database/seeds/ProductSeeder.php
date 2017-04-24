<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->delete();

        Product::create([
                'name' => 'boots',
                'manufacturer' => 'adidas',
                'price' => 100.00,
        ]);

        Product::create([
            'name' => 'boots',
            'manufacturer' => 'reebok',
            'price' => 120.00,
        ]);

        Product::create([
            'name' => 'boots',
            'manufacturer' => 'nike',
            'price' => 132.67,
        ]);

        Product::create([
            'name' => 'boots',
            'manufacturer' => 'saucony',
            'price' => 201.34,
        ]);

        Product::create([
            'name' => 'flip flops',
            'manufacturer' => 'crocs',
            'price' => 45.89,
        ]);

        Product::create([
            'name' => 'flip flops',
            'manufacturer' => 'quicksilver',
            'price' => 30.10,
        ]);

        Product::create([
                'name' => 't-skirt',
                'manufacturer' => 'adidas',
                'price' => 30.98,
        ]);

        Product::create([
            'name' => 't-skirt',
            'manufacturer' => 'reebok',
            'price' => 42.22,
        ]);

        Product::create([
            'name' => 't-skirt',
            'manufacturer' => 'nike',
            'price' => 53.20,
        ]);

        Product::create([
            'name' => 'hat',
            'manufacturer' => 'adidas',
            'price' => 13.20,
        ]);
    }
}
