<x-filament-panels::page>
    <div style="display: flex; flex-direction: column; gap: 1.75rem;">
        
        <!-- Row 1: Key Metrics Overview -->
        <div>
            @livewire(\App\Filament\Widgets\VisitorOverviewWidget::class)
        </div>

        <!-- Row 2: Visual Charts (Traffic Trend & Device Share) -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); gap: 1.5rem; align-items: start;">
            <div>
                @livewire(\App\Filament\Widgets\VisitorTrafficChart::class)
            </div>
            <div>
                @livewire(\App\Filament\Widgets\VisitorDevicesChart::class)
            </div>
        </div>

        <!-- Row 3: Top Visited Pages Ranking -->
        <div>
            @livewire(\App\Filament\Widgets\TopPagesWidget::class)
        </div>

        <!-- Row 4: Live Real-time Visitors Feed (Native Filament Table) -->
        <div>
            <div style="display: none;" aria-hidden="true">Log Kunjungan Langsung</div>
            @livewire(\App\Filament\Widgets\RecentVisitorsWidget::class)
        </div>

    </div>
</x-filament-panels::page>
