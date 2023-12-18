<?php

use Inertia\Inertia;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\GalleryResource;

Route::get('/', function () {
    return Inertia::render('Home', [
        'laravel' => \Illuminate\Foundation\Application::VERSION,
        'php' => PHP_VERSION,
    ]);
});

Route::get('/galleries/qr-scan/{slug}', function (Request $request, $slug) {
    $gallery = Gallery::where('slug', $slug)->with('images')->first();
    return Inertia::render('GalleryView', ['gallery' => new GalleryResource($gallery)]);
});
