<?php

namespace App\Filament\Resources\GalleryResource\Pages;

use App\Filament\Resources\GalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewQrCode extends ViewRecord
{
    protected static string $resource = GalleryResource::class;

    protected static string $view = 'filament-panels::resources.gallery-resource.pages.view-qr-code';

}
