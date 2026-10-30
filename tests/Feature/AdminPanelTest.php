<?php

namespace Tests\Feature;

use App\Filament\Resources\Settings\Pages\EditSetting;
use App\Filament\Widgets\LatestQuotations;
use App\Filament\Widgets\QuotationStatusChart;
use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\TopPagesWidget;
use App\Filament\Widgets\VisitorDevicesChart;
use App\Filament\Widgets\VisitorTrafficChart;
use App\Models\PageView;
use App\Models\Setting;
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

    public function test_login_page_renders_with_custom_branding(): void
    {
        $response = $this->get('/admin/login');

        $response->assertStatus(200);
        $response->assertSee('Bali Easy', false);
        $response->assertSee('SOURCING PORTAL', false);
        $response->assertSee('Demo Administrator Login', false);
        $response->assertSee('admin@balieasy.com', false);
        $response->assertSee('Back to Bali Easy Website', false);
    }

    public function test_admin_can_authenticate_via_login_page(): void
    {
        $admin = User::where('email', 'admin@balieasy.com')->first();

        $response = $this->post('/admin/login', [
            'email' => 'admin@balieasy.com',
            'password' => 'password',
        ]);

        $this->actingAs($admin);
        $this->assertAuthenticated();
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
        $response->assertSee('Perlu Ditindak', false);
        $response->assertSee('Sedang Diproses', false);
    }

    public function test_admin_can_view_quotation_details(): void
    {
        $admin = User::where('email', 'admin@balieasy.com')->first();
        $quotation = \App\Models\Quotation::create([
            'reference_no' => 'RFQ-TEST-001',
            'name' => 'John Designer',
            'email' => 'john@example.com',
            'whatsapp' => '+6281234567890',
            'company' => 'Studio Bali',
            'country' => 'Australia',
            'quantity' => '20 pcs',
            'description' => 'Solid teak outdoor chairs and dining table',
            'status' => 'new',
        ]);

        $response = $this->actingAs($admin)->get("/admin/quotations/{$quotation->id}");

        $response->assertStatus(200);
        $response->assertSee($quotation->reference_no);
        $response->assertSee($quotation->name);
    }

    public function test_admin_can_access_edit_quotation_page(): void
    {
        $admin = User::where('email', 'admin@balieasy.com')->first();
        $quotation = \App\Models\Quotation::create([
            'reference_no' => 'RFQ-TEST-002',
            'name' => 'Sarah Architect',
            'email' => 'sarah@example.com',
            'whatsapp' => '+6281234567891',
            'company' => 'Atelier Living',
            'country' => 'Singapore',
            'quantity' => '50 pcs',
            'description' => 'Rattan woven pendants and natural stone basins',
            'status' => 'quoted',
        ]);

        $response = $this->actingAs($admin)->get("/admin/quotations/{$quotation->id}/edit");

        $response->assertStatus(200);
        $response->assertSee($quotation->reference_no);
    }

    public function test_admin_can_update_setting(): void
    {
        $admin = User::where('email', 'admin@balieasy.com')->first();
        $setting = Setting::where('key', 'whatsapp_number')->first();

        Livewire::actingAs($admin)
            ->test(EditSetting::class, ['record' => $setting->getRouteKey()])
            ->fillForm([
                'value' => '+62 899 9999 9999',
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('settings', [
            'key' => 'whatsapp_number',
            'value' => '+62 899 9999 9999',
        ]);
    }

    public function test_public_website_traffic_is_tracked_by_visitor_middleware(): void
    {
        PageView::truncate();

        $this->withServerVariables(['HTTP_USER_AGENT' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_0 like Mac OS X) AppleWebKit/605.1.15 Mobile/15E148 Safari/604.1'])
            ->get('/');

        $this->assertDatabaseHas('page_views', [
            'path' => '/',
            'device' => 'Mobile',
        ]);

        $this->get('/where-to-stay-and-eat');

        $this->assertDatabaseHas('page_views', [
            'path' => '/where-to-stay-and-eat',
        ]);
    }

    public function test_visitor_traffic_chart_widget_renders(): void
    {
        $admin = User::where('email', 'admin@balieasy.com')->first();
        $this->actingAs($admin);

        Livewire::test(VisitorTrafficChart::class)
            ->assertSuccessful();
    }

    public function test_visitor_devices_chart_widget_renders(): void
    {
        $admin = User::where('email', 'admin@balieasy.com')->first();
        $this->actingAs($admin);

        Livewire::test(VisitorDevicesChart::class)
            ->assertSuccessful();
    }

    public function test_top_pages_widget_renders(): void
    {
        $admin = User::where('email', 'admin@balieasy.com')->first();
        $this->actingAs($admin);

        Livewire::test(TopPagesWidget::class)
            ->assertSuccessful();
    }

    public function test_visitor_overview_widget_renders(): void
    {
        $admin = User::where('email', 'admin@balieasy.com')->first();
        $this->actingAs($admin);

        Livewire::test(\App\Filament\Widgets\VisitorOverviewWidget::class)
            ->assertSuccessful()
            ->assertSee('Kunjungan Hari Ini')
            ->assertSee('Pengunjung Unik Total');
    }

    public function test_recent_visitors_widget_renders(): void
    {
        $admin = User::where('email', 'admin@balieasy.com')->first();
        $this->actingAs($admin);

        Livewire::test(\App\Filament\Widgets\RecentVisitorsWidget::class)
            ->assertSuccessful()
            ->assertSee('Log Kunjungan Langsung (Real-time Visitors Log)');
    }

    public function test_admin_can_access_visitor_analytics_page(): void
    {
        $admin = User::where('email', 'admin@balieasy.com')->first();

        $response = $this->actingAs($admin)->get('/admin/visitor-analytics');

        $response->assertStatus(200);
        $response->assertSee('Statistik &amp; Analisis Pengunjung Website', false);
        $response->assertSee('Log Kunjungan Langsung', false);
    }
}
