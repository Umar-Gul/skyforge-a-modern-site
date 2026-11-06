<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Demo accounts, one per portal. Run:  php artisan db:seed --class=PortalUserSeeder
 * Change these passwords (or delete the accounts) before the site goes public.
 */
class PortalUserSeeder extends Seeder
{
    public function run(): void
    {
        $accounts = [
            ['Demo Customer', 'customer@skyforge.test', 'customer', 'Northwind Air'],
            ['Demo Supplier', 'supplier@skyforge.test', 'supplier', 'Apex Components'],
            ['Demo Employee', 'employee@skyforge.test', 'employee', 'Skyforge Aviation'],
        ];

        foreach ($accounts as [$name, $email, $portal, $company]) {
            User::unguarded(fn () => User::updateOrCreate(
                ['email' => $email],
                ['name' => $name, 'password' => Hash::make('Skyforge#2026'), 'portal' => $portal, 'company' => $company],
            ));
        }
    }
}
