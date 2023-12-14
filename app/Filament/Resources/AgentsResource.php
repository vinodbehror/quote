<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgentsResource\Pages;
use App\Filament\Resources\AgentsResource\RelationManagers;
use App\Models\Agents;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class AgentsResource extends Resource
{
    protected static ?string $model = Agents::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('name')
                ->placeholder('Agent Name')
                ->required(),
            TextInput::make('email')
                ->placeholder('Email')
                ->email()
                ->required(),
            TextInput::make('phone')
                ->placeholder('Mobile No')
                ->tel()
                ->required(),
            TextInput::make('agency_name')
                ->placeholder('Agency Name')
                ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('name'),
                TextColumn::make('email'),
                TextColumn::make('phone'),
                TextColumn::make('agency_name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListAgents::route('/'),
            'create' => Pages\CreateAgents::route('/create'),
            'edit' => Pages\EditAgents::route('/{record}/edit'),
        ];
    }
}
