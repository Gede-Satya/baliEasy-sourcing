<?php

return [
    // Navbar
    'nav' => [
        'home' => 'Home',
        'about' => 'About Us',
        'categories' => 'Categories',
        'how_it_works' => 'How It Works',
        'stay_eat' => 'Stay & Eat',
        'contact' => 'Contact',
        'request_quote' => 'Request a Quote',
    ],

    // Hero Section
    'hero' => [
        'eyebrow' => 'BALI SOURCING & QUALITY CONTROL AGENCY',
        'title_part1' => 'Source from Indonesia.',
        'title_part2' => 'Without the headache.',
        'description' => 'We find vetted artisan workshops, negotiate honest local prices, and inspect every single item before it ships. You get exceptional craftsmanship without ever leaving your desk.',
        'btn_quote' => 'Request a Quote',
        'btn_explore' => 'Explore Catalog',
        'image_caption' => 'Master woodcarver shaping seasoned plantation teak in our partner workshop.',
        'stats' => [
            'workshops_num' => '100+',
            'workshops_label' => 'Vetted Workshops',
            'pricing_num' => '0%',
            'pricing_label' => 'Hidden Markups',
            'qc_num' => '100%',
            'qc_label' => 'Inspected Before Shipping',
        ],
    ],

    // Categories
    'categories' => [
        'eyebrow' => 'WHAT WE SOURCE',
        'title' => 'Curated Indonesian Craftsmanship',
        'subtitle' => 'Direct access to master woodworkers, stone carvers, weavers, and textile studios across Bali and Java.',
        'category_badge' => 'CATEGORY 0:num',
        'btn_view' => 'View Details',
        'items' => [
            'solid-wood' => [
                'name' => 'Solid Teak & Reclaimed Timber',
                'description' => 'Bespoke dining tables, outdoor daybeds, and architectural beams crafted from legal plantation and reclaimed teak.',
            ],
            'fibers-weaves' => [
                'name' => 'Natural Rattan & Basketry',
                'description' => 'Lounge chairs, pendant lighting, and storage baskets handwoven from raw rattan, seagrass, and water hyacinth.',
            ],
            'stone-terrazzo' => [
                'name' => 'Volcanic Stone & Terrazzo',
                'description' => 'Hand-carved river stone bathtubs, temple stone reliefs, and custom polished terrazzo fixtures for luxury villas.',
            ],
            'textiles-linen' => [
                'name' => 'Linen, Batik & Resort Textiles',
                'description' => 'Botanical-dyed linen homewares, hand-stamped traditional batik, cushion covers, and private-label resort wear.',
            ],
        ],
    ],

    // How It Works
    'how_it_works' => [
        'eyebrow' => 'HOW IT WORKS',
        'title' => 'From initial sketch to your warehouse door',
        'subtitle' => 'Four simple steps, handled by our team in Bali.',
        'step_badge' => 'Step 0:num',
        'steps' => [
            1 => [
                'title' => 'Send Your Brief',
                'description' => 'Photos, sketches, or quantities. We reply within 48 hours.',
            ],
            2 => [
                'title' => 'Approve Samples',
                'description' => 'We match the right makers and send prototypes.',
            ],
            3 => [
                'title' => 'Quality Checks',
                'description' => 'On-site inspections with photo reports.',
            ],
            4 => [
                'title' => 'Packed & Shipped',
                'description' => 'Export crating, one container, customs handled.',
            ],
        ],
    ],

    // Hospitality Banner
    'banner' => [
        'eyebrow' => 'CUSTOM & HOSPITALITY PROJECTS',
        'title' => 'Furnishing a villa, boutique resort, or retail brand?',
        'subtitle' => 'Custom dimensions, special timber finishes, or mixed-material assemblies. If Indonesian artisans can make it, we will source, inspect, and ship it for you.',
        'btn' => 'Tell Us About Your Project',
    ],

    // About Us / Why Work With Us
    'about' => [
        'eyebrow' => 'WHY CHOOSE US',
        'title' => 'Your eyes, ears, and hands in Bali',
        'subtitle' => 'No language barriers. No surprise defects. No mystery markups.',
        'description' => 'Buying overseas can feel like a gamble when you cannot inspect goods in person. We act as your dedicated local team on the ground, walking the factory floors, testing wood moisture, and protecting your investment from day one.',
        'highlight_title' => '100% Transparent Direct Pricing',
        'highlight_text' => 'You pay the actual workshop production cost. We charge a flat, transparent service fee for our sourcing, QC, and logistics management.',
        'pillar_badge' => 'WHY WORK WITH US 0:num',
        'pillars' => [
            1 => [
                'title' => 'Vetted Workshops',
                'description' => 'Legal timber (SVLK) and reliable makers only.',
            ],
            2 => [
                'title' => 'Strict Inspection',
                'description' => 'Moisture, joints, and crating checked before shipping.',
            ],
            3 => [
                'title' => 'Clear Communication',
                'description' => 'Fast replies in English via WhatsApp and email.',
            ],
            4 => [
                'title' => 'One Container',
                'description' => 'Many workshops, consolidated into a single shipment.',
            ],
        ],
    ],

    // Where to Stay & Eat
    'stay_eat' => [
        'eyebrow' => 'VISITING BALI?',
        'title' => 'Where to Stay & Where to Eat',
        'subtitle' => 'Planning an inspection trip? Here are two of our favorite vetted spots in Bali.',
        'badge_stay' => 'Where to Stay',
        'badge_eat' => 'Where to Eat',
        'btn_learn_more' => 'Learn More',
        'items' => [
            'hideout-bamboo-estate' => [
                'name' => 'Hideout Bamboo Estate',
                'description' => 'An iconic eco-luxury bamboo villa nestled between quiet jungle valleys and rice terraces. The perfect retreat while exploring artisanal workshops in Gianyar.',
            ],
            'kilo-kitchen-bali' => [
                'name' => 'Kilo Kitchen Bali',
                'description' => 'Modern industrial architecture paired with locally crafted terrazzo and teak interiors. Great food, great design inspiration.',
            ],
        ],
    ],

    // Contact / RFQ Form
    'contact' => [
        'eyebrow' => 'START A CONVERSATION',
        'title' => 'Tell us what you want to make',
        'subtitle' => 'Got a mood board, a sketch, or an order list? Send it over. We will assess workshop availability and reply with a transparent quote in 48 hours.',
        'name_label' => 'Full Name',
        'name_placeholder' => 'Your Name',
        'email_label' => 'Email Address',
        'email_placeholder' => 'buyer@example.com',
        'company_label' => 'Company or Brand Name',
        'company_placeholder' => 'Studio / Boutique / Hotel Name',
        'whatsapp_label' => 'WhatsApp / Phone Number',
        'whatsapp_placeholder' => '+1 234 567 8900',
        'category_label' => 'Product Category',
        'category_default' => 'Select a category...',
        'quantity_label' => 'Estimated Order Quantity',
        'quantity_placeholder' => 'e.g. 50 pcs / 1x 20ft Container',
        'description_label' => 'Project Details & Specifications',
        'description_placeholder' => 'Tell us what you want to produce: product types, materials, target dimensions, finishes, or custom designs...',
        'btn_submit' => 'Send My Sourcing Request',
    ],

    // Bottom CTA
    'bottom_cta' => [
        'eyebrow' => 'READY TO START?',
        'title' => 'Let us build your next collection in Indonesia.',
        'subtitle' => 'Zero commitment to inquire. Send your ideas today and see how simple sourcing in Bali can be.',
        'btn_quote' => 'Request a Free Quote',
        'btn_whatsapp' => 'Chat on WhatsApp',
    ],

    // Footer
    'footer' => [
        'description' => 'Dedicated procurement, quality inspection, and export container shipping agency based in Bali, Indonesia.',
        'categories_title' => 'Product Categories',
        'nav_title' => 'Navigation',
        'newsletter_title' => 'Newsletter',
        'newsletter_text' => 'Subscribe for seasonal updates on Indonesian craftsmanship, workshop visits, and shipping news.',
        'newsletter_placeholder' => 'Enter your email',
        'btn_subscribe' => 'Subscribe',
        'copyright' => 'Bali Easy Sourcing Agency. All rights reserved.',
        'staff_login' => 'Staff Login',
        'terms' => 'Terms of Service',
        'privacy' => 'Privacy Policy',
    ],
];

