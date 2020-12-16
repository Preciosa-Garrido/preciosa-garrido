<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
        * MULHERES
        */

        Product::create([
            'product' => 'Camisola mangas cumpridas',
            'price' => 853,
            'stock' => 17,
            'category_id' => 1,
            'barcode' => '994786885083',
            'description' => 'Feita de algodão',
            'image' => 'f-p-4.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Product::create([
            'product' => 'Camisa',
            'price' => 530,
            'stock' => 19,
            'category_id' => 1,
            'barcode' => '948776763673',
            'description' => 'Feita com ceda',
            'image' => 'f-p-3.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Product::create([
            'product' => 'Saia com top',
            'price' => 1500,
            'stock' => 23,
            'category_id' => 1,
            'barcode' => '8467626443',
            'description' => 'Feita de algodão',
            'image' => 'f-p-2.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Product::create([
            'product' => 'Colam e bluzinha',
            'price' => 5909,
            'stock' => 5,
            'category_id' => 1,
            'barcode' => '4808570968',
            'description' => 'Feita com ceda',
            'image' => 'f-p-1.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /**
        * HOMENS
        */

        Product::create([
            'product' => 'Camisola mangas cumpridas',
            'price' => 853,
            'stock' => 17,
            'category_id' => 2,
            'barcode' => '994786885083',
            'description' => 'Feita de algodão',
            'image' => 'f-p-6.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Product::create([
            'product' => 'Camisa a militar',
            'price' => 530,
            'stock' => 19,
            'category_id' => 2,
            'barcode' => '948776763673',
            'description' => 'Feita com ceda',
            'image' => 'f-p-7.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Product::create([
            'product' => 'Camisola do Manchester',
            'price' => 1500,
            'stock' => 23,
            'category_id' => 2,
            'barcode' => '8467626443',
            'description' => 'Feita de algodão',
            'image' => 'f-p-8.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Product::create([
            'product' => 'Manchester United',
            'price' => 5909,
            'stock' => 5,
            'category_id' => 2,
            'barcode' => '4808570968',
            'description' => 'Feita com ceda',
            'image' => 'f-p-9.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
