<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(3)->create();
        User::factory()->count(1)->state([
            'name' => 'daddy',
            'email' => 'daddy@gmail.com',
        ])->isAdmin(1)->create();
    }
}
