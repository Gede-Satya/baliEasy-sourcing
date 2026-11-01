<?php

namespace App\Providers;

use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (app()->environment('production') || isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL'])) {
            URL::forceScheme('https');
        }

        CreateAction::configureUsing(fn (CreateAction $action) => $action->createAnother(false));
        CreateRecord::disableCreateAnother();
        FileUpload::configureUsing(fn (FileUpload $upload) => $upload->disk('public')->visibility('public'));
    }
}
