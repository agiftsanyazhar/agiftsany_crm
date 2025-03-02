<?php

namespace Database\Seeders;

use App\Models\{Lead, User};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 1 admin
        User::create([
            'name' => 'Admin',
            'role' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        // Create 10 managers
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => 'Manajer ' . $i,
                'role' => 'manager',
                'email' => 'manajer' . $i . '@gmail.com',
                'password' => Hash::make('12345678'),
            ]);
        }

        // Create 100 leads
        for ($i = 1; $i <= 100; $i++) {
            $lead = User::create([
                'name' => '(Lead) Customer ' . $i,
                'role' => 'customer',
                'email' => 'customer' . $i . '@gmail.com',
                'password' => Hash::make('12345678'),
            ]);

            Lead::create([
                'user_id' => $lead->id,
                'name' => $lead->name,
                'email' => $lead->email,
                'phone' => fake()->phoneNumber(),
                'address' => fake()->address(),
                'status' => ['pending', 'approved', 'rejected'][rand(0, 2)],
            ]);
        }
    }
}
