<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\HowItWorksStep;
use App\Models\Page;
use App\Models\Partner;
use App\Models\Service;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'site_name' => 'Bali Easy Sourcing',
            'tagline' => 'Source from Indonesia. We make it easy.',
            'hero_eyebrow' => 'BALI SOURCING & QUALITY CONTROL AGENCY',
            'hero_title' => 'Source from Indonesia. We make it easy.',
            'hero_description' => 'Your trusted boots-on-the-ground sourcing agency in Bali. We connect international buyers, interior designers, and hospitality brands directly with vetted Indonesian artisans and ethical manufacturers.',
            'hero_image' => 'https://images.unsplash.com/photo-1544816155-12df9643f363?auto=format&fit=crop&w=1200&q=80',
            'hero_image_caption' => 'Handcrafted solid teak furniture production in our partner workshop.',
            'stat_1_number' => '100+ Verified',
            'stat_1_label' => 'Local Workshops',
            'stat_2_number' => 'Direct Pricing',
            'stat_2_label' => 'No Hidden Markups',
            'stat_3_number' => 'End-to-End',
            'stat_3_label' => 'QC & Global Shipping',
            'whatsapp_number' => '+62 812 3456 7890',
            'contact_email' => 'hello@balieasysourcing.com',
            'rfq_notification_email' => 'rfq@balieasysourcing.com',
            'instagram_url' => 'https://instagram.com/balieasysourcing',
            'address' => 'Jl. Pantai Batu Bolong, Canggu, Bali 80361, Indonesia',
            'cta_text' => 'Request a Quote',
        ];

        foreach ($defaultSettings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'group' => 'general']
            );
        }

        // 3. Product Categories
        $categories = [
            [
                'name' => 'Solid Teak & Reclaimed Wood',
                'slug' => 'solid-wood',
                'description' => 'Sustainably harvested reclaimed and plantation teak furniture with certified legal timber.',
                'cover_image' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 1,
            ],
            [
                'name' => 'Woven Rattan & Natural Fibers',
                'slug' => 'fibers-weaves',
                'description' => 'Handwoven chairs, lighting, and decor made by generational artisans in Indonesian weaving communities.',
                'cover_image' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 2,
            ],
            [
                'name' => 'Natural Stone, Terrazzo & Ceramics',
                'slug' => 'stone-terrazzo',
                'description' => 'Custom carved river stone basins, architectural wall panels, and polished terrazzo bathroomware.',
                'cover_image' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 3,
            ],
            [
                'name' => 'Textiles, Linens & Homeware',
                'slug' => 'textiles-linen',
                'description' => 'Handspun botanical linens, traditional batik fabrics, cushion covers, and private label resort wear.',
                'cover_image' => 'https://images.unsplash.com/photo-1606744824163-985d376605aa?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 4,
            ],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(
                ['slug' => $cat['slug']],
                [
                    'name' => $cat['name'],
                    'description' => $cat['description'],
                    'cover_image' => $cat['cover_image'],
                    'sort_order' => $cat['sort_order'],
                    'is_active' => true,
                ]
            );
        }

        // 4. How It Works Steps
        $steps = [
            [
                'title' => 'Submit Your Request',
                'description' => 'Send us your product photos, dimensions, target quantities, and material preferences through our simple quote form.',
                'sort_order' => 1,
            ],
            [
                'title' => 'Supplier Matching & Sampling',
                'description' => 'We connect your brief with trusted specialized manufacturers and create physical sample prototypes for your approval.',
                'sort_order' => 2,
            ],
            [
                'title' => 'Production & Quality Control',
                'description' => 'Our local inspectors visit the workshops during manufacturing to perform quality checks and send you detailed photo reports.',
                'sort_order' => 3,
            ],
            [
                'title' => 'Packaging & Global Shipping',
                'description' => 'Export-grade packaging, fumigation, container consolidation at our Bali warehouse, and customs documentation.',
                'sort_order' => 4,
            ],
        ];

        foreach ($steps as $st) {
            HowItWorksStep::updateOrCreate(
                ['title' => $st['title']],
                $st
            );
        }

        // 5. Why Choose Us / Services
        $pillars = [
            [
                'title' => 'Verified Local Workshops',
                'description' => 'We personally inspect every manufacturer, check legal timber licenses (SVLK), and ensure fair working conditions.',
                'icon' => 'shield-check',
                'sort_order' => 1,
            ],
            [
                'title' => 'Strict Multi-Stage Quality Control',
                'description' => 'Wood moisture testing, structural integrity checks, finish consistency, and drop-tested export packaging.',
                'icon' => 'check-badge',
                'sort_order' => 2,
            ],
            [
                'title' => 'Clear English & Local Communication',
                'description' => 'Fluent English-speaking project managers who understand international design standards, tolerances, and deadlines.',
                'icon' => 'chat-bubble-left-right',
                'sort_order' => 3,
            ],
            [
                'title' => 'Container Consolidation & Shipping',
                'description' => 'Combine orders from multiple workshops into a single shipping container at our central warehouse to save freight costs.',
                'icon' => 'truck',
                'sort_order' => 4,
            ],
        ];

        foreach ($pillars as $pil) {
            Service::updateOrCreate(
                ['title' => $pil['title']],
                $pil
            );
        }

        // 6. Partners (Stay & Eat in Bali)
        $partners = [
            [
                'type' => Partner::TYPE_STAY,
                'name' => 'Hideout Bamboo Estate',
                'slug' => 'hideout-bamboo-estate',
                'description' => 'Eco-luxury bamboo villa surrounded by scenic rice terraces. A favorite retreat for visiting interior designers and architects.',
                'area' => 'Ubud, Gianyar',
                'price_range' => '$$$',
                'cover_image' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?auto=format&fit=crop&w=800&q=80',
                'website_url' => 'https://example.com/hideout',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'type' => Partner::TYPE_EAT,
                'name' => 'Kilo Kitchen Bali',
                'slug' => 'kilo-kitchen-bali',
                'description' => 'Architectural dining venue featuring custom local terrazzo and teak interiors, serving contemporary Southeast Asian dishes.',
                'area' => 'Seminyak, Badung',
                'price_range' => '$$',
                'cover_image' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=800&q=80',
                'website_url' => 'https://example.com/kilo',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
            ],
        ];

        foreach ($partners as $partner) {
            Partner::updateOrCreate(
                ['slug' => $partner['slug']],
                $partner
            );
        }

        // 7. Pages
        $pages = [
            [
                'title' => 'About Us',
                'slug' => 'about-us',
                'content' => 'Bali Easy Sourcing is a Bali-based procurement and quality inspection agency connecting international buyers with verified Indonesian manufacturers.',
                'meta_title' => 'About Us | Bali Easy Sourcing',
                'meta_description' => 'Learn about Bali Easy Sourcing, our quality control process, and our local team in Bali.',
            ],
            [
                'title' => 'Terms of Service',
                'slug' => 'terms-of-service',
                'content' => 'Standard terms covering procurement oversight, sample approval, payment schedules, and export shipping.',
                'meta_title' => 'Terms of Service | Bali Easy Sourcing',
                'meta_description' => 'Terms and conditions for sourcing and quality control services.',
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'content' => 'We protect your product designs, commercial specifications, and contact details with strict confidentiality.',
                'meta_title' => 'Privacy Policy | Bali Easy Sourcing',
                'meta_description' => 'Privacy and confidentiality policy of Bali Easy Sourcing.',
            ],
        ];

        foreach ($pages as $p) {
            Page::updateOrCreate(
                ['slug' => $p['slug']],
                $p
            );
        }
    }
}
