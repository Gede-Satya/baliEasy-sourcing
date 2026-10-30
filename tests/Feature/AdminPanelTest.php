<?php

namespace Tests\Feature;

use App\Filament\Widgets\LatestQuotations;
use App\Filament\Widgets\QuotationStatusChart;
use App\Filament\Widgets\StatsOverview;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_guest_is_redirected_to_admin_login(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/admin/login');
    }

    public function test_admin_can_access_dashboard_and_see_branding_and_navigation(): void
    {
        $admin = User::where('email', 'admin@balieasy.com')->first();

        $response = $this->actingAs($admin)->get('/admin');

        $response->assertStatus(200);
        $response->assertSee('Bali Easy', false);
        $response->assertSee('SOURCING PORTAL', false);
        $response->assertSee('Quotations / RFQ', false);
        $response->assertSee('Where to Stay &amp; Eat', false);
        $response->assertSee('Catalog', false);
    }

    public function test_stats_overview_widget_renders_metrics(): void
    {
        $admin = User::where('email', 'admin@balieasy.com')->first();

        $this->actingAs($admin);

        Livewire::test(StatsOverview::class)
            ->assertSuccessful()
            ->assertSee('Total RFQ / Inquiries')
            ->assertSee('Catalog Products')
            ->assertSee('Where to Stay & Eat')
            ->assertSee('Newsletter Leads');
    }

    public function test_latest_quotations_widget_renders(): void
    {
        $admin = User::where('email', 'admin@balieasy.com')->first();

        $this->actingAs($admin);

        Livewire::test(LatestQuotations::class)
            ->assertSuccessful();
    }

    public function test_quotation_status_chart_widget_renders(): void
    {
        $admin = User::where('email', 'admin@balieasy.com')->first();

        $this->actingAs($admin);

        Livewire::test(QuotationStatusChart::class)
            ->assertSuccessful();
    }

    public function test_admin_can_access_quotations_list_page(): void
    {
        $admin = User::where('email', 'admin@balieasy.com')->first();

        $response = $this->actingAs($admin)->get('/admin/quotations');

        $response->assertStatus(200);
        $response->assertSee('Quotations / RFQ', false);
    }
}
