<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'category' => 'T-Shirt'
        ]);
        Category::create([
            'category' => 'Calçados'
        ]);
        Category::create([
            'category' => 'Alimentação'
        ]);
    }
}
