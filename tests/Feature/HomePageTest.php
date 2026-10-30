<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\NewsletterSubscriber;
use App\Models\Quotation;
use App\Models\Setting;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_homepage_loads_in_english_by_default(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('BALI EASY');
        $response->assertSee('Home');
        $response->assertSee('About Us');
        $response->assertSee('Curated Indonesian Craftsmanship');
        $response->assertSee('How It Works');
        $response->assertSee('Where to Stay & Where to Eat', false);
        $response->assertSee('Request a Quote');
    }

    public function test_can_switch_to_indonesian_locale(): void
    {
        // Switch to Indonesian
        $switchResponse = $this->get('/lang/id');
        $switchResponse->assertRedirect();

        // Check home with Indonesian session
        $response = $this->withSession(['locale' => 'id'])->get('/');

        $response->assertStatus(200);
        $response->assertSee('Beranda');
        $response->assertSee('Tentang Kami');
        $response->assertSee('Kategori');
        $response->assertSee('Cara Kerja');
        $response->assertSee('Minta Penawaran');
        $response->assertSee('Kurasi Kriya &amp; Manufaktur Indonesia', false);
        $response->assertSee('Tempat Menginap &amp; Kuliner Pilihan', false);
    }

    public function test_about_us_page_loads_in_english(): void
    {
        $response = $this->get('/about');

        $response->assertStatus(200);
        $response->assertSee('About Us');
        $response->assertSee('Connecting Global Vision with Balinese Craftsmanship');
        $response->assertSee('OUR STORY &amp; PURPOSE', false);
        $response->assertSee('500+');
        $response->assertSee('Start Sourcing With Us');
    }

    public function test_about_us_page_loads_in_indonesian(): void
    {
        $response = $this->withSession(['locale' => 'id'])->get('/about');

        $response->assertStatus(200);
        $response->assertSee('Tentang Kami');
        $response->assertSee('Menghubungkan Desain Global dengan Keahlian Pengrajin Bali');
        $response->assertSee('CERITA &amp; TUJUAN KAMI', false);
        $response->assertSee('Mulai Konsultasi Pengadaan');
    }

    public function test_categories_index_page_loads(): void
    {
        $response = $this->get('/categories');

        $response->assertStatus(200);
        $response->assertSee('Product Categories &amp; Materials', false);
        $response->assertSee('Solid Teak &amp; Reclaimed Timber', false);
        $response->assertSee('Natural Rattan &amp; Basketry', false);
    }

    public function test_category_show_page_loads_with_products(): void
    {
        $response = $this->get('/categories/solid-wood');

        $response->assertStatus(200);
        $response->assertSee('Solid Teak &amp; Reclaimed Timber', false);
        $response->assertSee('Bespoke Reclaimed Teak Dining Table');
        $response->assertSee('Curated Workshop Catalog');
    }

    public function test_stay_and_eat_page_loads_in_english(): void
    {
        $response = $this->get('/where-to-stay-and-eat');

        $response->assertStatus(200);
        $response->assertSee('Where to Stay &amp; Where to Eat in Bali', false);
        $response->assertSee('Hideout Bamboo Estate');
        $response->assertSee('The Slow Canggu');
        $response->assertSee('Kilo Kitchen Bali');
        $response->assertSee('VIP SOURCING VISIT CONCIERGE');
    }

    public function test_stay_and_eat_page_loads_in_indonesian(): void
    {
        $response = $this->withSession(['locale' => 'id'])->get('/where-to-stay-and-eat');

        $response->assertStatus(200);
        $response->assertSee('Rekomendasi Tempat Menginap &amp; Kuliner di Bali', false);
        $response->assertSee('Tempat Menginap');
        $response->assertSee('Tempat Kuliner');
    }

    public function test_stay_and_eat_page_filters_by_type(): void
    {
        $response = $this->get('/where-to-stay-and-eat?type=stay');

        $response->assertStatus(200);
        $response->assertSee('Hideout Bamboo Estate');
        $response->assertDontSee('Kilo Kitchen Bali');
    }

    public function test_can_submit_quote_request(): void
    {
        $category = Category::first();

        $response = $this->post('/rfq', [
            'name' => 'Alexander Wright',
            'email' => 'alex@designstudio.com',
            'company' => 'Wright Studio UK',
            'whatsapp' => '+447911123456',
            'country' => 'United Kingdom',
            'category_id' => $category?->id,
            'quantity' => '100 pcs',
            'description' => 'Custom reclaimed teak dining tables with hand-carved joinery for resort project.',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('rfq_success');

        $this->assertDatabaseHas('quotations', [
            'email' => 'alex@designstudio.com',
            'name' => 'Alexander Wright',
            'company' => 'Wright Studio UK',
        ]);
    }

    public function test_can_subscribe_to_newsletter(): void
    {
        $response = $this->post('/newsletter', [
            'email' => 'buyer@boutiquehotel.com',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('newsletter_success');

        $this->assertDatabaseHas('newsletter_subscribers', [
            'email' => 'buyer@boutiquehotel.com',
            'is_active' => true,
        ]);
    }

    public function test_contact_page_loads_in_english(): void
    {
        $response = $this->get('/contact');

        $response->assertStatus(200);
        $response->assertSee('Contact Bali Easy Sourcing');
        $response->assertSee('Instant WhatsApp Chat');
        $response->assertSee('Bali Studio &amp; Office', false);
        $response->assertSee('48-Hour Response Commitment');
    }

    public function test_contact_page_loads_in_indonesian(): void
    {
        $response = $this->withSession(['locale' => 'id'])->get('/contact');

        $response->assertStatus(200);
        $response->assertSee('Hubungi Bali Easy Sourcing');
        $response->assertSee('Chat WhatsApp Langsung');
        $response->assertSee('Studio &amp; Kantor di Bali', false);
        $response->assertSee('Komitmen Respon 48 Jam');
    }

    public function test_homepage_reflects_custom_settings_live(): void
    {
        Setting::where('key', 'site_name')->update(['value' => 'Nusantara Craft Sourcing']);
        Setting::where('key', 'whatsapp_number')->update(['value' => '+62 877 7777 8888']);
        Setting::where('key', 'hero_image_caption')->update(['value' => 'Special master artisan carved desk.']);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('NUSANTARA CRAFT SOURCING');
        $response->assertSee('+62 877 7777 8888');
        $response->assertSee('6287777778888');
        $response->assertSee('Special master artisan carved desk.');
    }

    public function test_client_can_view_live_project_tracking_page(): void
    {
        $project = \App\Models\SourcingProject::create([
            'title' => 'Teak Dining Tables & Rattan Lamps for Villa Canggu',
            'client_name' => 'Emma Watson Design',
            'client_company' => 'Watson Interiors UK',
            'client_email' => 'emma@watson.co.uk',
            'client_whatsapp' => '+447911999888',
            'client_country' => 'United Kingdom',
            'workshop_name' => 'Gianyar Teak Studio',
            'workshop_location' => 'Tegallalang, Bali',
            'stage' => \App\Models\SourcingProject::STAGE_PRODUCTION,
            'progress_percent' => 65,
        ]);

        $response = $this->get("/track/{$project->access_token}");

        $response->assertStatus(200);
        $response->assertSee($project->project_code);
        $response->assertSee('Teak Dining Tables &amp; Rattan Lamps for Villa Canggu', false);
        $response->assertSee('Emma Watson Design');
        $response->assertSee('Gianyar Teak Studio');
        $response->assertSee('65%');
    }

    public function test_tracking_page_returns_404_on_invalid_token(): void
    {
        $response = $this->get('/track/invalid_token_12345');
        $response->assertStatus(404);
    }
}
