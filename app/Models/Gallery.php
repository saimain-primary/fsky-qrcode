<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'title'];

    public function images()
    {
        return $this->hasMany(GalleryImage::class);
    }

    public function downloadQRCode($record): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $qr = QrCode::size(200)->format('png')->generate(asset('/') . 'galleries/qr-scan/' . $record->slug);
        $output_file = 'images/qr-code/' . $record->slug . '.png';
        Storage::disk('public')->put($output_file, $qr);
        return response()->download(public_path('/storage/') . $output_file);
    }
}
