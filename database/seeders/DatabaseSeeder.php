<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'position' => 'Interior Designer',
            'birthdate' => now(),
            'account_type' => 'architect',
            'gender' => 'male',
            'address' => '1234 Main St., Magalang, Pampanga',
            'phone_number' => '+639369999999',
            'email' => 'architect@gmail.com',
            'password' => \Hash::make('qweqwe'),
            'email_verified_at' => now(),
        ]);

        \App\Models\User::create([
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'birthdate' => now(),
            'account_type' => 'client',
            'gender' => 'female',
            'address' => '1234 Main St., Magalang, Pampanga',
            'phone_number' => '+639369999999',
            'email' => 'client@gmail.com',
            'password' => \Hash::make('qweqwe'),
            'email_verified_at' => now(),
        ]);

        \App\Models\User::create([
            'first_name' => 'John',
            'last_name' => 'Smith',
            'birthdate' => now(),
            'account_type' => 'admin',
            'gender' => 'male',
            'address' => '1234 Main St., Magalang, Pampanga',
            'phone_number' => '+639369999999',
            'email' => 'admin@gmail.com',
            'password' => \Hash::make('qweqwe'),
            'email_verified_at' => now(),
        ]);
    }
}
