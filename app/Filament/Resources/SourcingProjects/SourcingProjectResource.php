<?php

namespace App\Filament\Resources\SourcingProjects;

use App\Filament\Resources\SourcingProjects\Pages\CreateSourcingProject;
use App\Filament\Resources\SourcingProjects\Pages\EditSourcingProject;
use App\Filament\Resources\SourcingProjects\Pages\ListSourcingProjects;
use App\Filament\Resources\SourcingProjects\Pages\ViewSourcingProject;
use App\Filament\Resources\SourcingProjects\Schemas\SourcingProjectForm;
use App\Filament\Resources\SourcingProjects\Schemas\SourcingProjectInfolist;
use App\Filament\Resources\SourcingProjects\Tables\SourcingProjectsTable;
use App\Models\SourcingProject;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class SourcingProjectResource extends Resource
{
    protected static ?string $model = SourcingProject::class;

    protected static string | UnitEnum | null $navigationGroup = 'Sourcing & RFQ';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Proyek Sourcing Aktif';

    protected static ?string $modelLabel = 'Proyek Sourcing';

    protected static ?string $pluralModelLabel = 'Proyek Sourcing Aktif';

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $recordTitleAttribute = 'project_code';

    public static function getNavigationBadge(): ?string
    {
        $active = static::getModel()::whereNotIn('stage', ['delivered', 'on_hold'])->count();

        return $active > 0 ? (string) $active : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'info';
    }

    public static function form(Schema $schema): Schema
    {
        return SourcingProjectForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SourcingProjectInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SourcingProjectsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSourcingProjects::route('/'),
            'create' => CreateSourcingProject::route('/create'),
            'view' => ViewSourcingProject::route('/{record}'),
            'edit' => EditSourcingProject::route('/{record}/edit'),
        ];
    }
}

