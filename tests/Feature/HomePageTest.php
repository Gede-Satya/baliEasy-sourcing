<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\NewsletterSubscriber;
use App\Models\Quotation;
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
        $this->assertDatabaseHas('quotations', [
            'email' => 'alex@designstudio.com',
            'name' => 'Alexander Wright',
            'company' => 'Wright Studio UK',
        ]);
    }

    public function test_can_subscribe_to_newsletter(): void
    {
        $response = $this->post('/newsletter', [
            'email' => 'subscriber@example.com',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('newsletter_subscribers', [
            'email' => 'subscriber@example.com',
        ]);
    }
}
