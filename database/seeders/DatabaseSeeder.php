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

        // 2. Default Settings (Attractive, Human & Engaging Copy)
        $defaultSettings = [
            'site_name' => 'Bali Easy Sourcing',
            'tagline' => 'Source from Indonesia. We make it simple.',
            'hero_eyebrow' => 'BALI SOURCING & QUALITY CONTROL AGENCY',
            'hero_title' => 'Source from Indonesia. We make it simple.',
            'hero_description' => 'We find vetted artisan workshops, negotiate honest local prices, and inspect every single item before it ships. You get exceptional craftsmanship without ever leaving your desk.',
            'hero_image' => 'https://images.unsplash.com/photo-1544816155-12df9643f363?auto=format&fit=crop&w=1200&q=80',
            'hero_image_caption' => 'Master woodcarver shaping seasoned plantation teak in our partner workshop.',
            'stat_1_number' => '100+',
            'stat_1_label' => 'Vetted Workshops',
            'stat_2_number' => '0%',
            'stat_2_label' => 'Hidden Markups',
            'stat_3_number' => '100%',
            'stat_3_label' => 'Inspected Before Shipping',
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
                'name' => 'Solid Teak & Reclaimed Timber',
                'slug' => 'solid-wood',
                'description' => 'Bespoke dining tables, outdoor daybeds, and architectural beams crafted from legal plantation and reclaimed teak.',
                'cover_image' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 1,
            ],
            [
                'name' => 'Natural Rattan & Basketry',
                'slug' => 'fibers-weaves',
                'description' => 'Lounge chairs, pendant lighting, and storage baskets handwoven from raw rattan, seagrass, and water hyacinth.',
                'cover_image' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 2,
            ],
            [
                'name' => 'Volcanic Stone & Terrazzo',
                'slug' => 'stone-terrazzo',
                'description' => 'Hand-carved river stone bathtubs, temple stone reliefs, and custom polished terrazzo fixtures for luxury villas.',
                'cover_image' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 3,
            ],
            [
                'name' => 'Linen, Batik & Resort Textiles',
                'slug' => 'textiles-linen',
                'description' => 'Botanical-dyed linen homewares, hand-stamped traditional batik, cushion covers, and private-label resort wear.',
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
                'title' => 'Send Your Brief',
                'description' => 'Share your product photos, technical sketches, or target quantities. We evaluate feasibility within 48 hours.',
                'sort_order' => 1,
            ],
            [
                'title' => 'Review Physical Samples',
                'description' => 'We match your project with the right makers and ship physical prototypes for your approval before mass production.',
                'sort_order' => 2,
            ],
            [
                'title' => 'On-Site Quality Checks',
                'description' => 'Our inspectors visit the workshop at every critical stage. You receive detailed photo reports and moisture readings.',
                'sort_order' => 3,
            ],
            [
                'title' => 'Packed & Shipped',
                'description' => 'We crate your goods, consolidate multiple makers into one container, and handle customs clearance to your home port.',
                'sort_order' => 4,
            ],
        ];

        foreach ($steps as $st) {
            HowItWorksStep::updateOrCreate(
                ['title' => $st['title']],
                $st
            );
        }

        // 5. Why Work With Us
        $pillars = [
            [
                'title' => 'Handpicked Workshops',
                'description' => 'We only partner with established makers who respect legal timber laws (SVLK), artisan welfare, and delivery timelines.',
                'icon' => 'shield-check',
                'sort_order' => 1,
            ],
            [
                'title' => 'Rigorous Inspection Protocol',
                'description' => 'Wood moisture content testing, joint strength checks, drop-tested export crating, and high-resolution photo sign-offs.',
                'icon' => 'check-badge',
                'sort_order' => 2,
            ],
            [
                'title' => 'Fluent, Fast Communication',
                'description' => 'Direct WhatsApp and email updates in clear English. Real-time answers when you need them across all time zones.',
                'icon' => 'chat-bubble-left-right',
                'sort_order' => 3,
            ],
            [
                'title' => 'Full Container Consolidation',
                'description' => 'Order from ten different workshops and ship them all inside one container from our central Bali warehouse.',
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

        // 6. Where to Stay & Eat
        $partners = [
            [
                'type' => Partner::TYPE_STAY,
                'name' => 'Hideout Bamboo Estate',
                'slug' => 'hideout-bamboo-estate',
                'description' => 'An iconic eco-luxury bamboo villa nestled between quiet jungle valleys and rice terraces. The perfect retreat while exploring artisanal workshops in Gianyar.',
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
                'description' => 'Modern industrial architecture paired with locally crafted terrazzo and teak interiors. Great food, great design inspiration.',
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
