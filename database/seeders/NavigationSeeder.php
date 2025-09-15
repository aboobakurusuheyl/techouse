<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Navigation;

class NavigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Header Navigation
        $headerItems = [
            [
                'name' => 'Home',
                'url' => '/',
                'type' => 'link',
                'location' => 'header',
                'sort_order' => 1,
                'is_active' => true,
                'icon' => 'home',
            ],
            [
                'name' => 'Products',
                'url' => '/products',
                'type' => 'link',
                'location' => 'header',
                'sort_order' => 2,
                'is_active' => true,
                'icon' => 'shopping-bag',
            ],
            [
                'name' => 'About',
                'url' => '/about',
                'type' => 'link',
                'location' => 'header',
                'sort_order' => 3,
                'is_active' => true,
                'icon' => 'information-circle',
            ],
            [
                'name' => 'Contact',
                'url' => '/contact',
                'type' => 'link',
                'location' => 'header',
                'sort_order' => 4,
                'is_active' => true,
                'icon' => 'phone',
            ],
        ];

        // Footer Navigation
        $footerItems = [
            [
                'name' => 'Products',
                'url' => '/products',
                'type' => 'link',
                'location' => 'footer',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'About Us',
                'url' => '/about',
                'type' => 'link',
                'location' => 'footer',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Support',
                'url' => '/support',
                'type' => 'link',
                'location' => 'footer',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Privacy Policy',
                'url' => '/privacy',
                'type' => 'link',
                'location' => 'footer',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Terms of Service',
                'url' => '/terms',
                'type' => 'link',
                'location' => 'footer',
                'sort_order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($headerItems as $item) {
            Navigation::create($item);
        }

        foreach ($footerItems as $item) {
            Navigation::create($item);
        }
    }
}
