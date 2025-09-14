<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Smartphones',
                'slug' => 'smartphones',
                'description' => 'Mobile phones with advanced computing capabilities and connectivity features.',
                'icon' => '📱',
                'is_active' => true,
            ],
            [
                'name' => 'Laptops',
                'slug' => 'laptops',
                'description' => 'Portable personal computers designed for mobile use.',
                'icon' => '💻',
                'is_active' => true,
            ],
            [
                'name' => 'Tablets',
                'slug' => 'tablets',
                'description' => 'Mobile computing devices with touchscreen interfaces.',
                'icon' => '📱',
                'is_active' => true,
            ],
            [
                'name' => 'Headphones',
                'slug' => 'headphones',
                'description' => 'Audio devices worn over or in the ears for listening to sound.',
                'icon' => '🎧',
                'is_active' => true,
            ],
            [
                'name' => 'Smart Watches',
                'slug' => 'smart-watches',
                'description' => 'Wearable computing devices that resemble wristwatches.',
                'icon' => '⌚',
                'is_active' => true,
            ],
            [
                'name' => 'Gaming',
                'slug' => 'gaming',
                'description' => 'Devices and accessories designed for video gaming.',
                'icon' => '🎮',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}