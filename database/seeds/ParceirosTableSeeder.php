<?php

use App\Models\Parceiro;
use Illuminate\Database\Seeder;

class ParceirosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Parceiro::create([
        	'parceiro' => 'lorem',
        	'site' => 'http://ipsum.co.ao',
        	'logo' => 'parceiro_1551929022.png'
        ]);
    }
}
