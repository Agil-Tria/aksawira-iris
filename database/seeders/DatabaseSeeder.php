<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
     public function run(): void
    {
        $this->call([
            RoleSeeder::class,
        ]);

        $admin = User::first();

        if ($admin) {

            $admin->assignRole('admin');

            $admin->update([

                'status' => 'active'

            ]);
        }
    }


    // use WithoutModelEvents;

    // /**
    //  * Seed the application's database.
    //  */
    // public function run(): void
    // {
    //     // User::factory(10)->create();

    //     // User::factory()->create([
    //     //     'name' => 'Test User',
    //     //     'email' => 'test@example.com',
    //     // ]);
    //     $this->call([
    //         RoleSeeder::class,
    //     ]);
    // }
}
