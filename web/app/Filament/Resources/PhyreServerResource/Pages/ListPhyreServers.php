<?php

namespace App\Filament\Resources\TurboServerResource\Pages;

use App\Filament\Resources\TurboServerResource;
use App\Models\TurboServer;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ManageRecords;

class ListTurboServers extends ManageRecords
{
    protected static string $resource = TurboServerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('Sync Servers Resources')->action(function() {
                $findTurboServers = TurboServer::all();
                if ($findTurboServers->count() > 0) {
                    foreach ($findTurboServers as $turboServer) {
                        $turboServer->syncResources();
                    }
                }
            }),
            Actions\CreateAction::make(),
        ];
    }
}
