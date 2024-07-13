<?php

namespace App\Filament\Widgets;

use App\Models\Domain;
use App\Models\HostingSubscription;
use App\Models\TurboServer;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class Websites extends BaseWidget
{
    protected static bool $isLazy = false;

    protected static ?string $heading = 'Last created websites';

    protected int|string|array $columnSpan = 2;

    protected static ?int $sort = 5;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                HostingSubscription::query()
            )
            ->actions([
                Tables\Actions\Action::make('visit')
                    ->label('Open website')
                    ->icon('heroicon-m-arrow-top-right-on-square')
                    ->color('gray')
                    ->url(fn ($record): string => 'http://'.$record->domain, true),
            ])
            ->columns([

//                Tables\Columns\TextColumn::make('turbo_server_id')
//                    ->label('Server')
//                    ->badge()
//                    ->state(function ($record) {
//                        if ($record->turbo_server_id > 0) {
//                            $turboServer = TurboServer::where('id', $record->turbo_server_id)->first();
//                            if ($turboServer) {
//                                return $turboServer->name;
//                            }
//                        }
//                        return 'MAIN';
//                    })
//                    ->searchable()
//                    ->sortable(),

                Tables\Columns\TextColumn::make('domain'),
               // Tables\Columns\TextColumn::make('hostingPlan.name'),
                Tables\Columns\TextColumn::make('created_at'),
            ])->defaultSort('id', 'desc');
    }
}
