<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::updateOrCreate(
            ['email' => 'aboobakurusuhail@gmail.com'],
            [
                'name' => 'Aboobakuru Suhail',
                'password' => bcrypt('password'),
            ]
        );

        // Seed our product showcase data
        $this->call([
            BrandSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            NavigationSeeder::class,
            SiteSettingSeeder::class,
        ]);
    }
}
