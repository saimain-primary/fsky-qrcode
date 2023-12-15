<?php

namespace App\Filament\Resources\GalleryResource\Pages;

use App\Models\GalleryImage;
use Filament\Actions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\GalleryResource;

class CreateGallery extends CreateRecord
{
    protected static string $resource = GalleryResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        Log::info('record');
        Log::debug($this->record);
        $data['slug'] = rand(10000, 99999) . '-' . Str::random(10) . '-' . time();
        return $data;
    }


//    protected function handleRecordCreation(array $data): Model
//    {
//        $record = static::getModel()::create($data);
//        $imageData = [
//        ];
//
//        $requestImages = array_map(function ($img) {
//            $imageData[] = [
//                'gallery_id' => $data['']
//            ]
//        }, $data['images']);
//
//        Log::debug($data);
////        $record->detail()->create($data['detail']);
//
//        return $record;
//    }
}
