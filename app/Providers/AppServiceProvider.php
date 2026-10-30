<?php

namespace App\Providers;

use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\CreateRecord;
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
        CreateAction::configureUsing(fn (CreateAction $action) => $action->createAnother(false));
        CreateRecord::disableCreateAnother();
        FileUpload::configureUsing(fn (FileUpload $upload) => $upload->disk('public')->visibility('public'));
    }
}
