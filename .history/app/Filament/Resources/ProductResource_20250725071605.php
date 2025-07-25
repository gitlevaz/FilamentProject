<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Actions\Action as TableAction;

use Filament\Forms\Components\Actions\Action as FormAction;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;

use App\Jobs\ProcessProductJob;

use Illuminate\Support\Facades\Http;
use Filament\Notifications\Notification;


class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Textarea::make('description')->rows(3),

                Select::make('product_category_id')
                    ->relationship('category', 'name')
                    ->required(),

                Select::make('product_color_id')
                    ->relationship('color', 'name')
                    ->searchable(),


                TextInput::make('api_unique_number')
                    ->suffixAction(
                        FormAction::make('validate')
                            ->label('Check')
                            ->action(function ($state, $livewire) {
                                sleep(2);
                                Notification::make()
                                    ->title("Validated: {$state}")
                                    ->success()
                                    ->send();
                            })
                            ->extraAttributes(['wire:loading.class' => 'animate-spin'])
                    ),
                // TextInput::make('address')
                //     ->label('Address / Zip Code')
                //     ->required()
                //     ->suffixAction(
                //         FormAction::make('validate')
                //             ->label('Fetch')
                //             ->icon('heroicon-o-arrow-path')
                //             ->action(function ($state, $livewire) {
                //                 $response = Http::get("https://api.zippopotam.us/us/{$state}");

                //                 if ($response->ok() && isset($response['places'][0])) {
                //                     $place = $response['places'][0]['place name'];
                //                     $stateName = $response['places'][0]['state'];

                //                     Notification::make()
                //                         ->title("Address Found: {$place}, {$stateName}")
                //                         ->success()
                //                         ->send();
                //                 } else {
                //                     Notification::make()
                //                         ->title("Address not found for: {$state}")
                //                         ->danger()
                //                         ->send();
                //                 }
                //             })
                //             ->extraAttributes(['wire:loading.class' => 'animate-spin'])
                //     ),

                TextInput::make('address')
                    ->label('Address')
                    ->placeholder('e.g., 20 King Street')
                    ->suffixAction(
                        FormAction::make('validate')
                            ->label('Fetch')
                            ->icon('heroicon-o-arrow-path')
                            ->action(function ($state, $livewire) {
                                try {
                                    // ✅ Extract street details from full address
                                    $fullAddress = $state; // e.g., "20 King Street"
                                    preg_match('/^(\d+)\s+([\w\s]+)\s+(Street|Avenue|Road|Lane|Boulevard)$/i', $fullAddress, $matches);

                                    $streetNumber = $matches[1] ?? null;
                                    $streetName   = $matches[2] ?? null;
                                    $streetType   = $matches[3] ?? null;

                                    if (!$streetNumber || !$streetName || !$streetType) {
                                        Notification::make()
                                            ->title("Invalid address format! Use e.g., 20 King Street")
                                            ->danger()
                                            ->send();
                                        return;
                                    }

                                    // ✅ 1. Get Bearer Token
                                    $loginResponse = Http::post('https://extranet.asmorphic.com/api/login', [
                                        'email' => 'project-test@projecttest.com.au',
                                        'password' => 'oxhyV9NzkZ^02MEB',
                                    ]);

                                    if (!$loginResponse->ok()) {
                                        Notification::make()
                                            ->title("Login failed")
                                            ->danger()
                                            ->send();
                                        return;
                                    }

                                    $token = $loginResponse->json('token');

               // ✅ 2. Find Address (Debug Mode)
$payload = [
    'company_id' => 17,
    'street_number' => $streetNumber,
    'street_name' => $streetName,
    'street_type' => $streetType,
    'suburb' => 'Melbourne',
    'postcode' => '3000',
    'state' => 'VIC',
];

logger()->info('API Payload:', $payload);

$findResponse = Http::withHeaders([
    'Authorization' => "Bearer {$token}",
])->post('https://extranet.asmorphic.com/api/orders/findaddress', [
    'company_id' => 17,
    'address' => '120 Queen Road', // Full address
]);

logger()->info('API Response:', $findResponse->json());

if (!$findResponse->ok() || empty($findResponse->json())) {
    Notification::make()
        ->title("Address not found: {$state}")
        ->danger()
        ->send();
    return;
}

                                    // ✅ 3. Qualify Address
                                    $qualifyResponse = Http::withHeaders([
                                        'Authorization' => "Bearer {$token}",
                                        'Accept' => 'application/json',
                                    ])->post('https://extranet.asmorphic.com/api/orders/qualify', [
                                        'company_id' => 17,
                                        'qualification_identifier' => 'LOCXXXX',
                                        'service_type_id' => 3,
                                    ]);

                                    if ($qualifyResponse->ok() && $qualifyResponse->json('result') === 'Success') {
                                        $serviceType = $qualifyResponse->json('data')[0]['ServiceType'] ?? 'Unknown';

                                        Notification::make()
                                            ->title("Qualified! Service: {$serviceType}")
                                            ->success()
                                            ->send();
                                    } else {
                                        Notification::make()
                                            ->title("Qualification failed for: ")
                                            ->danger()
                                            ->send();
                                    }
                                } catch (\Exception $e) {
                                    Notification::make()
                                        ->title("Error: " . $e->getMessage())
                                        ->danger()
                                        ->send();
                                }
                            })
                            ->extraAttributes(['wire:loading.class' => 'animate-spin'])
                    )


            ]);
    }



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('category.name')->label('Category'),
                TextColumn::make('color.name')->label('Color'),

                /** Status Badge color**/
                BadgeColumn::make('status_bar')
                    ->label('Status')
                    ->getStateUsing(fn($record) => 'Hello')

                    ->color(fn($record) => match ($record->color->name) {
                        'Red' => 'danger',      // red
                        'Blue' => 'info',       // blue
                        'Green' => 'success',   // green
                        'Yellow' => 'warning',    // Yellow
                        'Black' => 'gray',      // grayish
                        'Purple' => 'secondary', // secondary (violet-like)
                        default => 'gray',
                    })
            ])
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),

                /** Job Button **/
                TableAction::make('process')
                    ->label('Process')
                    ->action(function ($record) {
                        ProcessProductJob::dispatch($record);

                        Notification::make()
                            ->title('Job dispatched!')
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    /**  READ VIEW **/
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('name'),
                TextEntry::make('description'),
                TextEntry::make('category.name')->label('Category'),
                TextEntry::make('color.name')->label('Color'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
            'view' => Pages\ViewProduct::route('/{record}'),
        ];
    }
}
