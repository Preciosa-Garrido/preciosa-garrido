<?php

use App\Models\Promotion;
use Illuminate\Database\Seeder;

class PromotionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Promotion::create([
        	'id' => 1,
            'product_id' => 1,
        	'desconto' => '25',
        	'promotion_end' => now(),
        	'created_at' => now(),
        	'updated_at' => now(),
        ]);
    }
}
