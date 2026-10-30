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
            $createdCat = Category::updateOrCreate(
                ['slug' => $cat['slug']],
                [
                    'name' => $cat['name'],
                    'description' => $cat['description'],
                    'cover_image' => $cat['cover_image'],
                    'sort_order' => $cat['sort_order'],
                    'is_active' => true,
                ]
            );

            // Add sample curated products for each category
            if ($cat['slug'] === 'solid-wood') {
                Product::updateOrCreate(
                    ['slug' => 'bespoke-reclaimed-teak-dining-table'],
                    [
                        'category_id' => $createdCat->id,
                        'name' => 'Bespoke Reclaimed Teak Dining Table',
                        'short_description' => 'Solid reclaimed Indonesian teak dining table with natural hand-rubbed wax finish.',
                        'description' => 'Sourced from historic Javanese structures, this dining table highlights authentic timber grain and heritage joinery. Built to withstand coastal climate with zero shrinkage.',
                        'material' => 'Grade A Reclaimed Teak',
                        'dimensions' => '240 x 100 x 76 cm',
                        'finish' => 'Matte Wax / Water-resistant PU',
                        'moq' => '5 pcs',
                        'cover_image' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=800&q=80',
                        'is_featured' => true,
                        'is_active' => true,
                    ]
                );
                Product::updateOrCreate(
                    ['slug' => 'minimalist-suar-wood-console'],
                    [
                        'category_id' => $createdCat->id,
                        'name' => 'Minimalist Suar Wood Console Table',
                        'short_description' => 'Live edge Suar hardwood console with blackened iron frame.',
                        'description' => 'Custom kiln-dried Suar wood slab console table made for luxury hotel foyers and private villas.',
                        'material' => 'Suar Wood & Powder-coated Steel',
                        'dimensions' => '180 x 45 x 85 cm',
                        'finish' => 'Natural Satin',
                        'moq' => '5 pcs',
                        'cover_image' => 'https://images.unsplash.com/photo-1538688525198-9b88f6f53126?auto=format&fit=crop&w=800&q=80',
                        'is_featured' => true,
                        'is_active' => true,
                    ]
                );
            } elseif ($cat['slug'] === 'fibers-weaves') {
                Product::updateOrCreate(
                    ['slug' => 'handwoven-rattan-armchair'],
                    [
                        'category_id' => $createdCat->id,
                        'name' => 'Handwoven Rattan Lounge Armchair',
                        'short_description' => 'Ergonomic natural wicker lounge chair crafted by Cirebon weavers.',
                        'description' => 'Handwoven natural rattan core over a sustainable bamboo and teak frame. Ideal for covered outdoor patios and boutique suites.',
                        'material' => 'Natural Rattan & Teak Wood',
                        'dimensions' => '78 x 82 x 75 cm',
                        'finish' => 'Clear Protective Sealer',
                        'moq' => '10 pcs',
                        'cover_image' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?auto=format&fit=crop&w=800&q=80',
                        'is_featured' => true,
                        'is_active' => true,
                    ]
                );
            } elseif ($cat['slug'] === 'stone-terrazzo') {
                Product::updateOrCreate(
                    ['slug' => 'monolithic-river-stone-bathtub'],
                    [
                        'category_id' => $createdCat->id,
                        'name' => 'Monolithic River Stone Bathtub',
                        'short_description' => 'Carved from single volcanic river boulder with polished inner bowl.',
                        'description' => 'Individually carved by master stonecutters in East Java. Each piece possesses a unique natural silhouette and organic exterior texture.',
                        'material' => 'Natural Volcanic River Stone',
                        'dimensions' => 'Approx. 190 x 110 x 60 cm',
                        'finish' => 'Honed & Sealed Interior, Raw Chiseled Exterior',
                        'moq' => '1 pc',
                        'cover_image' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?auto=format&fit=crop&w=800&q=80',
                        'is_featured' => true,
                        'is_active' => true,
                    ]
                );
            } elseif ($cat['slug'] === 'textiles-linen') {
                Product::updateOrCreate(
                    ['slug' => 'botanical-dyed-linen-throw-cushions'],
                    [
                        'category_id' => $createdCat->id,
                        'name' => 'Botanical-Dyed Raw Linen Cushion Covers',
                        'short_description' => 'Heavyweight stone-washed European flax dyed with indigo and mangosteen peel.',
                        'description' => 'Eco-dyed artisanal linen textiles produced in collaboration with Gianyar dye studios. Hypoallergenic and preshrunk for hospitality durability.',
                        'material' => '100% Organic Linen',
                        'dimensions' => '50 x 50 cm / 60 x 60 cm',
                        'finish' => 'Natural Plant Pigment',
                        'moq' => '25 pcs',
                        'cover_image' => 'https://images.unsplash.com/photo-1606744824163-985d376605aa?auto=format&fit=crop&w=800&q=80',
                        'is_featured' => true,
                        'is_active' => true,
                    ]
                );
            }
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
                'type' => Partner::TYPE_STAY,
                'name' => 'The Slow Canggu',
                'slug' => 'the-slow-canggu',
                'description' => 'Brutalist architecture draped in native greenery, displaying curated contemporary Indonesian art and custom timber fittings just minutes from Batu Bolong beach.',
                'area' => 'Batu Bolong, Canggu',
                'price_range' => '$$$',
                'cover_image' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=800&q=80',
                'website_url' => 'https://example.com/the-slow',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'type' => Partner::TYPE_STAY,
                'name' => 'Bambu Indah Heritage Retreat',
                'slug' => 'bambu-indah-retreat',
                'description' => 'Restored antique Javanese bridal homes perched above the Ayung River. A masterclass in traditional timber craftsmanship and ecological luxury.',
                'area' => 'Sayan, Ubud',
                'price_range' => '$$$$',
                'cover_image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=800&q=80',
                'website_url' => 'https://example.com/bambu-indah',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 3,
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
                'sort_order' => 4,
            ],
            [
                'type' => Partner::TYPE_EAT,
                'name' => 'Mason Canggu',
                'slug' => 'mason-canggu',
                'description' => 'Artisanal wood-fired grill celebrating prime ingredients, house-cured charcuterie, and understated terracotta courtyard aesthetics.',
                'area' => 'Batu Bolong, Canggu',
                'price_range' => '$$',
                'cover_image' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=800&q=80',
                'website_url' => 'https://example.com/mason',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'type' => Partner::TYPE_EAT,
                'name' => 'Locavore NXT',
                'slug' => 'locavore-nxt',
                'description' => 'A culinary research lab championing 100% indigenous Indonesian ingredients, wild edibles, and fermentation in a sustainable architectural complex.',
                'area' => 'Ubud, Gianyar',
                'price_range' => '$$$$',
                'cover_image' => 'https://images.unsplash.com/photo-1550966871-3ed3cdb5ed0c?auto=format&fit=crop&w=800&q=80',
                'website_url' => 'https://example.com/locavore',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 6,
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
