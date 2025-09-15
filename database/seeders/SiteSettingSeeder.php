<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General Settings
            [
                'key' => 'site_name',
                'value' => 'TEC HOUSE',
                'type' => 'text',
                'group' => 'general',
                'description' => 'The name of the website',
            ],
            [
                'key' => 'site_tagline',
                'value' => 'Your trusted partner for quality electronics and technology products.',
                'type' => 'textarea',
                'group' => 'general',
                'description' => 'The tagline or description of the website',
            ],
            [
                'key' => 'logo_url',
                'value' => '/images/logo.webp',
                'type' => 'image',
                'group' => 'general',
                'description' => 'URL to the site logo',
            ],

            // Contact Settings
            [
                'key' => 'contact_phone',
                'value' => '+234 123 456 7890',
                'type' => 'text',
                'group' => 'contact',
                'description' => 'Primary contact phone number',
            ],
            [
                'key' => 'contact_email',
                'value' => 'info@techouse.com',
                'type' => 'text',
                'group' => 'contact',
                'description' => 'Primary contact email address',
            ],
            [
                'key' => 'contact_address',
                'value' => 'Lagos, Nigeria',
                'type' => 'text',
                'group' => 'contact',
                'description' => 'Physical address',
            ],

            // Social Media Settings
            [
                'key' => 'social_facebook',
                'value' => 'https://facebook.com/techouse',
                'type' => 'text',
                'group' => 'social',
                'description' => 'Facebook page URL',
            ],
            [
                'key' => 'social_twitter',
                'value' => 'https://twitter.com/techouse',
                'type' => 'text',
                'group' => 'social',
                'description' => 'Twitter profile URL',
            ],
            [
                'key' => 'social_instagram',
                'value' => 'https://instagram.com/techouse',
                'type' => 'text',
                'group' => 'social',
                'description' => 'Instagram profile URL',
            ],
            [
                'key' => 'social_linkedin',
                'value' => 'https://linkedin.com/company/techouse',
                'type' => 'text',
                'group' => 'social',
                'description' => 'LinkedIn company page URL',
            ],

            // Footer Settings
            [
                'key' => 'footer_copyright',
                'value' => '© 2025 TecHouse. All rights reserved.',
                'type' => 'text',
                'group' => 'footer',
                'description' => 'Copyright text for footer',
            ],
            [
                'key' => 'footer_description',
                'value' => 'Your trusted partner for quality electronics and technology products.',
                'type' => 'textarea',
                'group' => 'footer',
                'description' => 'Description text for footer',
            ],

            // SEO Settings
            [
                'key' => 'meta_title',
                'value' => 'TEC HOUSE - Quality Electronics & Technology',
                'type' => 'text',
                'group' => 'seo',
                'description' => 'Default meta title for SEO',
            ],
            [
                'key' => 'meta_description',
                'value' => 'Shop the latest electronics and technology products at TEC HOUSE. Quality products, competitive prices, and excellent customer service.',
                'type' => 'textarea',
                'group' => 'seo',
                'description' => 'Default meta description for SEO',
            ],
            [
                'key' => 'meta_keywords',
                'value' => 'electronics, technology, gadgets, phones, laptops, accessories, Nigeria',
                'type' => 'text',
                'group' => 'seo',
                'description' => 'Default meta keywords for SEO',
            ],
        ];

        foreach ($settings as $setting) {
            SiteSetting::create($setting);
        }
    }
}
