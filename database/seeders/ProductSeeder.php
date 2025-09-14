<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $brands = Brand::all()->keyBy('slug');
        $categories = Category::all()->keyBy('slug');

        $products = [
            // Apple Products
            [
                'name' => 'iPhone 15 Pro',
                'slug' => 'iphone-15-pro',
                'description' => 'The most advanced iPhone with titanium design, A17 Pro chip, and Pro camera system.',
                'short_description' => 'Titanium design with A17 Pro chip',
                'price' => 999.00,
                'sale_price' => 899.00,
                'sku' => 'IPH15P-128',
                'stock_quantity' => 50,
                'images' => [
                    'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone-15-pro-finish-select-202309-6-1inch-naturaltitanium?wid=5120&hei=3280&fmt=p-jpg&qlt=80&.v=1693009279821',
                    'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone-15-pro-finish-select-202309-6-1inch-naturaltitanium_AV1?wid=5120&hei=3280&fmt=p-jpg&qlt=80&.v=1693009279821'
                ],
                'specifications' => [
                    'Display' => '6.1-inch Super Retina XDR',
                    'Chip' => 'A17 Pro',
                    'Camera' => '48MP Main, 12MP Ultra Wide, 12MP Telephoto',
                    'Storage' => '128GB',
                    'Color' => 'Natural Titanium'
                ],
                'is_featured' => true,
                'is_active' => true,
                'brand_id' => $brands['apple']->id,
                'category_id' => $categories['smartphones']->id,
            ],
            [
                'name' => 'MacBook Air M2',
                'slug' => 'macbook-air-m2',
                'description' => 'Supercharged by the M2 chip, MacBook Air delivers exceptional performance and all-day battery life.',
                'short_description' => 'M2 chip with all-day battery life',
                'price' => 1199.00,
                'sale_price' => null,
                'sku' => 'MBA-M2-256',
                'stock_quantity' => 30,
                'images' => [
                    'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/macbook-air-midnight-select-20220606?wid=904&hei=840&fmt=jpeg&qlt=90&.v=1653084303665'
                ],
                'specifications' => [
                    'Chip' => 'Apple M2',
                    'Display' => '13.6-inch Liquid Retina',
                    'Memory' => '8GB unified memory',
                    'Storage' => '256GB SSD',
                    'Color' => 'Midnight'
                ],
                'is_featured' => true,
                'is_active' => true,
                'brand_id' => $brands['apple']->id,
                'category_id' => $categories['laptops']->id,
            ],
            [
                'name' => 'AirPods Pro (2nd generation)',
                'slug' => 'airpods-pro-2nd-gen',
                'description' => 'AirPods Pro with Active Noise Cancellation, Adaptive Transparency, and Personalized Spatial Audio.',
                'short_description' => 'Active Noise Cancellation with Spatial Audio',
                'price' => 249.00,
                'sale_price' => 199.00,
                'sku' => 'APP2-GEN2',
                'stock_quantity' => 100,
                'images' => [
                    'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/MQD83?wid=1144&hei=1144&fmt=jpeg&qlt=90&.v=1660803972361'
                ],
                'specifications' => [
                    'Chip' => 'H2 chip',
                    'Battery Life' => 'Up to 6 hours listening time',
                    'Case' => 'MagSafe Charging Case',
                    'Features' => 'Active Noise Cancellation, Adaptive Transparency'
                ],
                'is_featured' => false,
                'is_active' => true,
                'brand_id' => $brands['apple']->id,
                'category_id' => $categories['headphones']->id,
            ],

            // Samsung Products
            [
                'name' => 'Galaxy S24 Ultra',
                'slug' => 'galaxy-s24-ultra',
                'description' => 'The most powerful Galaxy smartphone with AI-powered features and S Pen.',
                'short_description' => 'AI-powered with S Pen included',
                'price' => 1299.99,
                'sale_price' => 1199.99,
                'sku' => 'GS24U-256',
                'stock_quantity' => 40,
                'images' => [
                    'https://images.samsung.com/us/smartphones/galaxy-s24-ultra/images/galaxy-s24-ultra-highlights-design-titanium-black-back-mo.jpg'
                ],
                'specifications' => [
                    'Display' => '6.8-inch Dynamic AMOLED 2X',
                    'Chip' => 'Snapdragon 8 Gen 3',
                    'Camera' => '200MP Main, 50MP Periscope, 10MP Telephoto',
                    'Storage' => '256GB',
                    'Color' => 'Titanium Black'
                ],
                'is_featured' => true,
                'is_active' => true,
                'brand_id' => $brands['samsung']->id,
                'category_id' => $categories['smartphones']->id,
            ],
            [
                'name' => 'Galaxy Tab S9 Ultra',
                'slug' => 'galaxy-tab-s9-ultra',
                'description' => 'The largest Galaxy tablet with S Pen and powerful performance for productivity and creativity.',
                'short_description' => '14.6-inch tablet with S Pen',
                'price' => 1199.99,
                'sale_price' => null,
                'sku' => 'GTS9U-256',
                'stock_quantity' => 25,
                'images' => [
                    'https://images.samsung.com/us/tablets/galaxy-tab-s9-ultra/images/galaxy-tab-s9-ultra-highlights-design-back-mo.jpg'
                ],
                'specifications' => [
                    'Display' => '14.6-inch Dynamic AMOLED 2X',
                    'Chip' => 'Snapdragon 8 Gen 2',
                    'Storage' => '256GB',
                    'S Pen' => 'Included',
                    'Color' => 'Graphite'
                ],
                'is_featured' => false,
                'is_active' => true,
                'brand_id' => $brands['samsung']->id,
                'category_id' => $categories['tablets']->id,
            ],

            // Google Products
            [
                'name' => 'Pixel 8 Pro',
                'slug' => 'pixel-8-pro',
                'description' => 'The most advanced Pixel phone with Google AI and the best camera system.',
                'short_description' => 'Google AI with advanced camera',
                'price' => 999.00,
                'sale_price' => 899.00,
                'sku' => 'P8P-128',
                'stock_quantity' => 35,
                'images' => [
                    'https://store.google.com/product/pixel_8_pro_hero'
                ],
                'specifications' => [
                    'Display' => '6.7-inch LTPO OLED',
                    'Chip' => 'Google Tensor G3',
                    'Camera' => '50MP Main, 48MP Ultra Wide, 48MP Telephoto',
                    'Storage' => '128GB',
                    'Color' => 'Obsidian'
                ],
                'is_featured' => true,
                'is_active' => true,
                'brand_id' => $brands['google']->id,
                'category_id' => $categories['smartphones']->id,
            ],
            [
                'name' => 'Pixel Watch 2',
                'slug' => 'pixel-watch-2',
                'description' => 'The most helpful watch with Google services and health insights.',
                'short_description' => 'Google services with health insights',
                'price' => 349.99,
                'sale_price' => 299.99,
                'sku' => 'PW2-41MM',
                'stock_quantity' => 60,
                'images' => [
                    'https://store.google.com/product/pixel_watch_2_hero'
                ],
                'specifications' => [
                    'Display' => '1.2-inch AMOLED',
                    'Chip' => 'Qualcomm Snapdragon W5',
                    'Battery' => 'Up to 24 hours',
                    'Features' => 'Google Assistant, Health tracking'
                ],
                'is_featured' => false,
                'is_active' => true,
                'brand_id' => $brands['google']->id,
                'category_id' => $categories['smart-watches']->id,
            ],

            // Microsoft Products
            [
                'name' => 'Surface Laptop 5',
                'slug' => 'surface-laptop-5',
                'description' => 'The most balanced Surface laptop with 12th Gen Intel Core processors.',
                'short_description' => '12th Gen Intel Core with premium design',
                'price' => 999.99,
                'sale_price' => null,
                'sku' => 'SL5-256',
                'stock_quantity' => 20,
                'images' => [
                    'https://img-prod-cms-rt-microsoft-com.akamaized.net/cms/api/am/imageFileData/RE4OXzi?ver=3a58'
                ],
                'specifications' => [
                    'Display' => '13.5-inch PixelSense',
                    'Processor' => '12th Gen Intel Core i5',
                    'Storage' => '256GB SSD',
                    'Color' => 'Platinum'
                ],
                'is_featured' => false,
                'is_active' => true,
                'brand_id' => $brands['microsoft']->id,
                'category_id' => $categories['laptops']->id,
            ],

            // Sony Products
            [
                'name' => 'WH-1000XM5 Headphones',
                'slug' => 'wh-1000xm5-headphones',
                'description' => 'Industry-leading noise canceling with Dual Noise Sensor technology.',
                'short_description' => 'Industry-leading noise canceling',
                'price' => 399.99,
                'sale_price' => 349.99,
                'sku' => 'WH1000XM5',
                'stock_quantity' => 45,
                'images' => [
                    'https://www.sony.com/image/5a0b8b8b8b8b8b8b8b8b8b8b'
                ],
                'specifications' => [
                    'Driver' => '30mm dynamic',
                    'Battery' => 'Up to 30 hours',
                    'Features' => 'Dual Noise Sensor, Quick Attention mode',
                    'Color' => 'Black'
                ],
                'is_featured' => true,
                'is_active' => true,
                'brand_id' => $brands['sony']->id,
                'category_id' => $categories['headphones']->id,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}