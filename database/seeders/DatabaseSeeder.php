<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $managerRole = Role::firstOrCreate(['name' => 'manager']);

        $admin = User::firstOrCreate(
            ['email' => 'admin@mail.com'],
            [
                'name' => 'admin',
                'password' => Hash::make('password'),
            ]
        );
        $admin->assignRole($adminRole);

        $manager = User::firstOrCreate(
            ['email' => 'manager@mail.com'],
            [
                'name' => 'manager',
                'password' => Hash::make('password'),
            ]
        );
        $manager->assignRole($managerRole);

        $customers = Customer::factory()->count(10)->create();

        foreach ($customers as $customer) {
            $amount = rand(1, 2);
            Ticket::factory()->count($amount)->create([
                'customer_id' => $customer->id,
            ]);
        }
    }
}
