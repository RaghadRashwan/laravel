<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory()->count(10)->create();
         //\App\Models\BlogPost::factory()->times(10)->create();

        // \App\Models\User::factory()->create([
         //   'name' => 'Test User',
        //    'email' => 'test@example.com',
        // ]);
        $this->call([
            RoleAndPermissionSeeder::class,
            
        ]);
    }
}
