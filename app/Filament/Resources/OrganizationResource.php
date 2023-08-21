<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrganizationResource\Pages;
use App\Filament\Resources\OrganizationResource\RelationManagers;
use App\Models\Organization;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Squire\Models\Country;

class OrganizationResource extends Resource
{
    protected static ?string $model = Organization::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('name')->required(),
                    TextInput::make('email')->unique()->email()->required(),
                    TextInput::make('phone')->tel()->required(),
                    TextInput::make('address')->required(),
                    TextInput::make('city')->required(),
                    TextInput::make('region')->required(),
                    Select::make('country')
                        ->options(Country::query()->pluck('name', 'code_2'))
                        ->searchable()
                        ->required(),
                    TextInput::make('postal_code')->required(),
                ])
                ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('phone')->searchable(),
                TextColumn::make('city')->searchable()->sortable(),
                TextColumn::make('country')->searchable()->sortable(),
            ])
            ->filters([
                SelectFilter::make('deleted_at')
                    ->options([
                        'with-trashed' => 'With Trashed',
                        'only-trashed' => 'Only Trashed',
                    ])->query(function (Builder $query, array $data) {
                        $query->when($data['value'] === 'with-trashed', function (Builder $query) {
                            $query->withTrashed();
                        })->when($data['value'] === 'only-trashed', function (Builder $query) {
                            $query->onlyTrashed();
                        });
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->account();
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrganizations::route('/'),
            'create' => Pages\CreateOrganization::route('/create'),
            'edit' => Pages\EditOrganization::route('/{record}/edit'),
        ];
    }
}
