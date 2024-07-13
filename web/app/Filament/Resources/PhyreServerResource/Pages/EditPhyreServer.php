<?php

namespace App\Filament\Resources\TurboServerResource\Pages;

use App\Filament\Resources\TurboServerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTurboServer extends EditRecord
{
    protected static string $resource = TurboServerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
