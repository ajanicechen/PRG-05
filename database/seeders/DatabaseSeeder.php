<?php

namespace Database\Seeders;

use App\Models\Character;
use App\Models\Vision;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'adminkun',
            'role' => 'admin',
            'email'=> 'i.am.adminkun@mail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$yZUVtEnaVogmABnNIsxW9eIc5JjcgIBUzUsK2k3VRbzrA8MbwF60.'
        ]);
        Character::factory(8)->has(Vision::factory())->create();
    }
}
