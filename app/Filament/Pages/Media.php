<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use BackedEnum;
use Illuminate\Support\Facades\Storage;

class Media extends Page
{
    protected string $view = 'filament.pages.media';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Photo;
    protected static ?string $recordTitleAttribute = 'Paper';

    public function getImages(): array
    {
        $mediaPath = 'media';
        
        if (!Storage::disk('public')->exists($mediaPath)) {
            return [];
        }

        $files = Storage::disk('public')->files($mediaPath);

        // Filter only image files
        $images = array_filter($files, function ($file) {
            $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            return in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']);
        });

        // Get public URLs for images
        return array_map(function ($file) {
            return asset('storage/' . str_replace('\\', '/', $file));
        }, $images);
    }

    public function deleteImage(string $imagePath): void
    {
        // Extract the file path from the URL
        $urlPath = str_replace(asset('storage/'), '', $imagePath);
        $filePath = 'media/' . basename($urlPath);

        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }
    }
}
