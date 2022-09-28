<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@domain.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ])->assignRole('admin');

        // User::factory(10)->create();
    }
}
