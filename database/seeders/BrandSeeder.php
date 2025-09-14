<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Apple',
                'slug' => 'apple',
                'description' => 'Apple Inc. is an American multinational technology company that specializes in consumer electronics, computer software, and online services.',
                'logo' => 'https://logo.clearbit.com/apple.com',
                'website' => 'https://apple.com',
                'is_active' => true,
            ],
            [
                'name' => 'Samsung',
                'slug' => 'samsung',
                'description' => 'Samsung Electronics is a South Korean multinational electronics corporation and the flagship company of the Samsung Group.',
                'logo' => 'https://logo.clearbit.com/samsung.com',
                'website' => 'https://samsung.com',
                'is_active' => true,
            ],
            [
                'name' => 'Google',
                'slug' => 'google',
                'description' => 'Google LLC is an American multinational technology company that specializes in Internet-related services and products.',
                'logo' => 'https://logo.clearbit.com/google.com',
                'website' => 'https://google.com',
                'is_active' => true,
            ],
            [
                'name' => 'Microsoft',
                'slug' => 'microsoft',
                'description' => 'Microsoft Corporation is an American multinational technology corporation which produces computer software, consumer electronics, personal computers, and related services.',
                'logo' => 'https://logo.clearbit.com/microsoft.com',
                'website' => 'https://microsoft.com',
                'is_active' => true,
            ],
            [
                'name' => 'Sony',
                'slug' => 'sony',
                'description' => 'Sony Corporation is a Japanese multinational conglomerate corporation that specializes in electronics, gaming, entertainment, and financial services.',
                'logo' => 'https://logo.clearbit.com/sony.com',
                'website' => 'https://sony.com',
                'is_active' => true,
            ],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}