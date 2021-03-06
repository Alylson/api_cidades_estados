<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('desafio01'),
            'created_at' => now(),
        ]);

        $this->command->info('Usuário cadastrado com sucesso!');
    }
}
