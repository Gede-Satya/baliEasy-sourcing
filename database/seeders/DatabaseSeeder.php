<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\HowItWorksStep;
use App\Models\Page;
use App\Models\Service;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Super Admin User
        User::firstOrCreate(
            ['email' => 'admin@balieasy.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'role' => User::ROLE_SUPER_ADMIN,
                'email_verified_at' => now(),
            ]
        );

        // 2. Default Settings
        $defaultSettings = [
            'site_name' => 'BaliEasy Sourcing',
            'whatsapp_number' => '+6281234567890',
            'contact_email' => 'hello@balieasy.com',
            'rfq_notification_email' => 'rfq@balieasy.com',
            'instagram_url' => 'https://instagram.com/balieasy',
            'address' => 'Seminyak, Bali, Indonesia',
            'hero_heading' => 'Authentic Bali Products, Directly Sourced For You',
            'hero_subheading' => 'Your trusted on-the-ground sourcing and quality control partner in Bali.',
            'cta_text' => 'Request a Quote',
        ];

        foreach ($defaultSettings as $key => $value) {
            Setting::firstOrCreate(
                ['key' => $key],
                ['value' => $value, 'group' => 'general']
            );
        }

        // 3. Sample Categories
        $categories = [
            ['name' => 'Furniture', 'slug' => 'furniture', 'description' => 'Teak wood, rattan, and bespoke handcrafted furniture.'],
            ['name' => 'Home Decor', 'slug' => 'home-decor', 'description' => 'Ceramics, lighting, macrame, and artisanal ornaments.'],
            ['name' => 'Textiles & Garments', 'slug' => 'textiles-garments', 'description' => 'Linen, batik, resort wear, and custom woven fabrics.'],
            ['name' => 'Handicrafts', 'slug' => 'handicrafts', 'description' => 'Stone carving, basketry, and authentic Balinese crafts.'],
        ];

        foreach ($categories as $index => $cat) {
            Category::firstOrCreate(
                ['slug' => $cat['slug']],
                [
                    'name' => $cat['name'],
                    'description' => $cat['description'],
                    'sort_order' => $index,
                    'is_active' => true,
                ]
            );
        }

        // 4. Sample Pages
        $pages = [
            [
                'title' => 'About Us',
                'slug' => 'about-us',
                'content' => 'BaliEasy Sourcing is an export and sourcing agency bridging international buyers with verified Balinese artisans and manufacturers.',
                'meta_title' => 'About Us - BaliEasy Sourcing',
                'meta_description' => 'Learn more about BaliEasy Sourcing and our mission to support local artisans.',
            ],
            [
                'title' => 'Terms of Service',
                'slug' => 'terms-of-service',
                'content' => 'General terms and conditions for procurement, inspection, and shipping services.',
                'meta_title' => 'Terms of Service - BaliEasy Sourcing',
                'meta_description' => 'Terms and conditions of BaliEasy Sourcing services.',
            ],
        ];

        foreach ($pages as $p) {
            Page::firstOrCreate(
                ['slug' => $p['slug']],
                $p
            );
        }

        // 5. Sample Services
        $services = [
            [
                'title' => 'Supplier Sourcing & Price Negotiation',
                'description' => 'We connect you directly with authentic workshops and negotiate fair wholesale prices.',
                'icon' => 'heroicon-o-magnifying-glass',
                'sort_order' => 1,
            ],
            [
                'title' => 'Sample Development & Prototyping',
                'description' => 'Supervise custom designs, materials, and finishings before mass production.',
                'icon' => 'heroicon-o-cube',
                'sort_order' => 2,
            ],
            [
                'title' => 'Quality Inspection & Packing',
                'description' => 'Rigorous on-site inspection, high-resolution photo reports, and export packing.',
                'icon' => 'heroicon-o-shield-check',
                'sort_order' => 3,
            ],
            [
                'title' => 'Freight & Customs Clearance',
                'description' => 'Full container (FCL) or less-than-container (LCL) freight coordination worldwide.',
                'icon' => 'heroicon-o-truck',
                'sort_order' => 4,
            ],
        ];

        foreach ($services as $srv) {
            Service::firstOrCreate(
                ['title' => $srv['title']],
                $srv
            );
        }

        // 6. How It Works Steps
        $steps = [
            [
                'title' => 'Submit Your RFQ',
                'description' => 'Send us your product ideas, specs, quantities, and target timeline.',
                'sort_order' => 1,
            ],
            [
                'title' => 'Supplier Matching & Quote',
                'description' => 'We locate verified producers and provide transparent cost breakdowns.',
                'sort_order' => 2,
            ],
            [
                'title' => 'Production & QC Inspection',
                'description' => 'Our team monitors the production timeline and conducts quality checks.',
                'sort_order' => 3,
            ],
            [
                'title' => 'Consolidation & Global Shipping',
                'description' => 'Goods are consolidated in our warehouse and safely shipped to your destination.',
                'sort_order' => 4,
            ],
        ];

        foreach ($steps as $st) {
            HowItWorksStep::firstOrCreate(
                ['title' => $st['title']],
                $st
            );
        }
    }
}
