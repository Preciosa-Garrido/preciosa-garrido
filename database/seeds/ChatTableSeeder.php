<?php

use App\Models\Chat;
use Illuminate\Database\Seeder;

class ChatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Chat::create([
        	'user_id' => 1,
        	'admin_id' => 1,
        	'gestor_id' => null,
            'sender' => 'user',
        	'message' => 'Olá tudo bem'
        ]);
        Chat::create([
        	'user_id' => 1,
        	'admin_id' => 2,
        	'gestor_id' => null,
            'sender' => 'admin',
        	'message' => 'Tudo rolando'
        ]);
        Chat::create([
        	'user_id' => 1,
        	'admin_id' => null,
        	'gestor_id' => 2,
            'sender' => 'gestor',
        	'message' => 'Como vai'
        ]);
        Chat::create([
        	'user_id' => 2,
        	'admin_id' => 2,
        	'gestor_id' => null,
            'sender' => 'admin',
        	'message' => 'Tá tudo tranquilo'
        ]);

        Chat::create([
        	'user_id' => 2,
        	'admin_id' => null,
        	'gestor_id' => 2,
            'sender' => 'user',
        	'message' => 'Olá tudo bem contigo'
        ]);
        Chat::create([
        	'user_id' => 1,
        	'admin_id' => null,
        	'gestor_id' => 1,
            'sender' => 'gestor',
        	'message' => 'Tudo rolando na tua casa'
        ]);
        Chat::create([
        	'user_id' => 3,
        	'admin_id' => null,
        	'gestor_id' => 2,
            'sender' => 'gestor',
        	'message' => 'Como vai isso ai família'
        ]);
        Chat::create([
        	'user_id' => 3,
        	'admin_id' => 2,
        	'gestor_id' => null,
            'sender' => 'admin',
        	'message' => 'Tá tudo tranquilo aí em casa'
        ]);
    }
}
