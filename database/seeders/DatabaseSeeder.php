<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\HowItWorksStep;
use App\Models\Page;
use App\Models\Partner;
use App\Models\Product;
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
            'hero_eyebrow' => 'BALI-BASED SOURCING AGENCY',
            'hero_title' => 'Source from Indonesia. We make it easy.',
            'hero_description' => 'Your trusted boots-on-the-ground sourcing agency in Bali. We connect international buyers, interior designers, and hospitality brands directly with vetted Indonesian artisans and ethical manufacturers.',
            'hero_image' => 'https://images.unsplash.com/photo-1544816155-12df9643f363?auto=format&fit=crop&w=1200&q=80',
            'hero_image_caption' => 'Bespoke solid teak table crafting at our partner workshop in Jepara & Bali.',
            'stat_1_number' => '100+ Vetted',
            'stat_1_label' => 'Ethical Workshops',
            'stat_2_number' => 'Direct Pricing',
            'stat_2_label' => 'No Hidden Markups',
            'stat_3_number' => 'End-to-End',
            'stat_3_label' => 'QC & Global Shipping',
            'whatsapp_number' => '+62 812 3456 7890',
            'contact_email' => 'hello@balieasysourcing.com',
            'rfq_notification_email' => 'rfq@balieasysourcing.com',
            'instagram_url' => 'https://instagram.com/balieasysourcing',
            'address' => 'Jl. Pantai Batu Bolong, Canggu, Bali 80361, Indonesia',
            'cta_text' => 'Start Your RFQ',
        ];

        foreach ($defaultSettings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'group' => 'general']
            );
        }

        // 3. Disciplines / Categories
        $categories = [
            [
                'name' => 'Jepara Teak & Root Wood',
                'slug' => 'solid-wood',
                'description' => 'Sustainably harvested reclaimed and plantation teak with SVLK legal timber certification.',
                'cover_image' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 1,
            ],
            [
                'name' => 'Woven Rattan & Seagrass',
                'slug' => 'fibers-weaves',
                'description' => 'Handwoven natural fibers crafted by multigenerational weavers in rural artisanal communities.',
                'cover_image' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 2,
            ],
            [
                'name' => 'Volcanic Stone, Terrazzo & Shell',
                'slug' => 'stone-terrazzo',
                'description' => 'Custom carved river stone, volcanic bas-reliefs, and polished terrazzo architectural fixtures.',
                'cover_image' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 3,
            ],
            [
                'name' => 'Traditional Textiles & Resort Wear',
                'slug' => 'textiles-linen',
                'description' => 'Handspun botanical-dyed linens, artisanal batik, and private label natural resort apparel.',
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
                'title' => 'Brief & Scope',
                'description' => 'Submit reference photos, CAD files, target quantities, and material requirements through our simple RFQ portal.',
                'sort_order' => 1,
            ],
            [
                'title' => 'Vendor Matching & Sampling',
                'description' => 'We match your brief with vetted specialized artisans and produce physical prototypes for your inspection and sign-off.',
                'sort_order' => 2,
            ],
            [
                'title' => 'Production & In-Line QC',
                'description' => 'Our team conducts regular on-site milestone inspections throughout production with detailed high-res photo reports.',
                'sort_order' => 3,
            ],
            [
                'title' => 'Packaging & Global Logistics',
                'description' => 'Export-grade crating, timber fumigation, customs documentation, and container consolidation at our central Bali hub.',
                'sort_order' => 4,
            ],
        ];

        foreach ($steps as $st) {
            HowItWorksStep::updateOrCreate(
                ['title' => $st['title']],
                $st
            );
        }

        // 5. Why Choose Us / Value Pillars (Services table)
        $pillars = [
            [
                'title' => 'Physical On-Site Verification',
                'description' => 'We personally visit every workshop, inspect working conditions, verify legal timber (SVLK) licenses, and ensure artisan well-being.',
                'icon' => 'shield-check',
                'sort_order' => 1,
            ],
            [
                'title' => 'Multi-Stage Quality Control',
                'description' => 'Moisture content testing for timber, structural integrity checks, finish consistency, and drop-tested export packaging.',
                'icon' => 'check-badge',
                'sort_order' => 2,
            ],
            [
                'title' => 'Direct Western Communication',
                'description' => 'Fluent English-speaking project managers who understand western design standards, commercial tolerances, and deadlines.',
                'icon' => 'chat-bubble-left-right',
                'sort_order' => 3,
            ],
            [
                'title' => 'Multi-Supplier Container Loading',
                'description' => 'Combine orders from 10+ different artisans into a single shipping container at our central warehouse to slash freight costs.',
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

        // 6. Partners (The Bali Instinct: Stay & Eat)
        $partners = [
            [
                'type' => Partner::TYPE_STAY,
                'name' => 'Hideout Bamboo Estate',
                'slug' => 'hideout-bamboo-estate',
                'description' => 'Eco-luxury bamboo residence surrounded by sacred rice terraces. Preferred retreat for visiting interior designers and architects.',
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
                'description' => 'Architectural dining space showcasing locally fabricated terrazzo and teak furnishings alongside contemporary Southeast Asian cuisine.',
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

        // 7. Static Pages
        $pages = [
            [
                'title' => 'About Bali Easy Sourcing',
                'slug' => 'about-us',
                'content' => 'Bali Easy Sourcing is an export and sourcing agency bridging international buyers with verified Balinese artisans and ethical manufacturers.',
                'meta_title' => 'About Us | Bali Easy Sourcing',
                'meta_description' => 'Learn more about Bali Easy Sourcing, our boots-on-the-ground team, and ethical craftsmanship.',
            ],
            [
                'title' => 'Terms & Sourcing Policy',
                'slug' => 'terms-of-service',
                'content' => 'Standard terms covering procurement oversight, sampling, payment milestones, quality inspection protocols, and export shipping.',
                'meta_title' => 'Terms of Service | Bali Easy Sourcing',
                'meta_description' => 'Terms and conditions of Bali Easy Sourcing services.',
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'content' => 'Your privacy is paramount. We protect your custom designs, commercial specifications, and contact details with strict non-disclosure.',
                'meta_title' => 'Privacy Policy | Bali Easy Sourcing',
                'meta_description' => 'Privacy policy and non-disclosure standards for Bali Easy Sourcing clients.',
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
