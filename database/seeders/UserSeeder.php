<?php

namespace Database\Seeders;

use App\Models\User;
use App\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role_id' => Role::ADMINISTRATOR->value,
            'password' => 'rahasia123',
        ]);

        User::factory()->create([
            'name' => 'Manager',
            'email' => 'manager@example.com',
            'role_id' => Role::MANAGER->value,
            'password' => 'rahasia123',
        ]);

        User::factory()->create([
            'name' => 'Employee',
            'email' => 'employee@example.com',
            'role_id' => Role::EMPLOYEE->value,
            'password' => 'rahasia123',
        ]);
    }
}
