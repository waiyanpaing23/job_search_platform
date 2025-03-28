<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $this->call(CategorySeeder::class);
        $this->call(SkillSeeder::class);

        User::factory()->create([
            'first_name' => 'superadmin',
            'last_name' => null,
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('superadmin567'),
            'role' => 'admin'
        ]);
    }
}
