<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuotesResource\Pages;
use App\Filament\Resources\QuotesResource\RelationManagers;
use App\Models\Quotes;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Checkbox;
use Illuminate\Support\HtmlString;
class QuotesResource extends Resource
{
    protected static ?string $model = Quotes::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Rate limiting')
                    ->description('Prevent abuse by limiting the number of requests per period')
                    ->schema([

                        Wizard::make([
                            Wizard\Step::make('Deal Details')
                                ->icon('heroicon-m-shopping-bag')
                                ->columns(2)
                                ->schema([
                                    Radio::make('Deal Type')
                                            ->inline()
                                            ->options([
                                                'B2B' => 'B2B',
                                                'B2C' => 'B2C',
                                            ]),
                                    Forms\Components\Select::make('agent_id')
                                            ->relationship('agent', 'name')
                                            ->searchable()
                                            ->preload()
                                            ->createOptionForm([
                                                Forms\Components\TextInput::make('name')
                                                    // ->required()
                                                    ->maxLength(255),
                                                Forms\Components\TextInput::make('email')
                                                    ->label('Email address')
                                                    ->email()
                                                    // ->required()
                                                    ->maxLength(255),
                                                Forms\Components\TextInput::make('phone')
                                                    ->label('Phone number')
                                                    ->tel(),
                                                    // ->required(),
                                            ])
                                            // ->required()
                                ]),
                            Wizard\Step::make('Tourist')
                              
                                ->description('Tourist Details')
                                ->columns(2)
                                ->schema([
                                    TextInput::make('name')
                                        ->placeholder('Name'),
                                        // ->required(),
                                    TextInput::make('email')
                                        ->placeholder('Email')
                                        ->email(),
                                        // ->required(),
                                    TextInput::make('phone')
                                        ->placeholder('Mobile No')
                                        ->tel(),
                                        // ->required(),
                                    TextInput::make('no-of-person')
                                        ->placeholder('No of person')
                                        ->numeric(),
                                      //  ->required(),
                                    DatePicker::make('arrival-date')
                                        ->native(false)
                                        ->firstDayOfWeek(7),
                                    DatePicker::make('departure-date')
                                        ->native(false)
                                ]),
                            Wizard\Step::make('Hotel Type')
                                ->schema([
                                    Checkbox::make('Already Booked')->inline(),
                                    Repeater::make('hotel')
                                        ->schema([
                                            TextInput::make('name'),
                                            Select::make('stars')
                                                ->options([
                                                    'one' => 'One',
                                                    'two' => 'Two',
                                                    'three' => 'Three',
                                                    'four' => 'Four',
                                                    'five' => 'Five',
                                                ]),
                                                // ->required(),
                                            DatePicker::make('checkindate')
                                                ->native(false)
                                                ->firstDayOfWeek(7),
                                            DatePicker::make('checkout-date')
                                                ->native(false),
                                            TextInput::make('amount')
                                                ->numeric(),
                                            Select::make('room-type')
                                                ->options([
                                                    'room' => 'Room Only',
                                                    'withbreakfast' => 'Room With Breakfast',
                                                ]),
                                            TextInput::make('location')
                                                
                                            
                                        ])
                                        
                                        ->columns(7)
                                ]),
                        ])->submitAction(new HtmlString('<button type="submit" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Submit</button>'))
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListQuotes::route('/'),
            'create' => Pages\CreateQuotes::route('/create'),
            'edit' => Pages\EditQuotes::route('/{record}/edit'),
        ];
    }
}
