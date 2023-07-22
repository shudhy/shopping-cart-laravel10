<?php

namespace Database\Seeders;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Product 1',
            'price' => 10,
            'description' => 'This is the first sample product.',
        ]);
        Product::create([
            'name' => 'Product 2',
            'price' => 20,
            'description' => 'This is the second sample product.',
        ]);
        Product::create([
            'name' => 'Product 3',
            'price' => 15,
            'description' => 'This is the third sample product.',
        ]);
    }
}
